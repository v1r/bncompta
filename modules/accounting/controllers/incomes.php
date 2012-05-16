<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Incomes extends Entreprises {

    function __construct() {
        parent::__construct();
        $this->load->model('accounting_model');
        $this->config->load('form_validation');
        $this->template->set_partial('sidebar', 'tpl/accounting_year/sidebar');
        $this->template->append_metadata('<script type="text/javascript" src="' . THEME_PATH . 'js/ajaxfileupload.js"></script>');
        $this->template->set_partial('navigation', 'tpl/bank_statements/navigation_view');
    }

    public function index() {
        if ($_POST) {
            if ($this->input->post('oper') == 'edit') {
                $data = array(
                    'id' => $this->input->post('bs_id'),
                    'date' => strtotime($this->input->post('date')),
                    'description' => $this->input->post('description'),
                    'label' => underscore($this->input->post('label')),
                    'bank_account_id' => $this->input->post('bank_account_id'),
                    'ammount' => number_format($this->input->post('ammount'), 2, '.', ''),
                );

                $this->accounting_model->update_bank_statement_row($data);
            }
            if ($this->input->post('oper') == 'del') {
                $id = $this->input->post('bs_id');
                $this->accounting_model->delete_bank_statement_row($id);
            }
        } else {
            $this->template->set_partial('filters', 'tpl/bank_statements/filters');
            $entreprise_id = $this->current_entreprise;
            $this->data->bank_statements = $bank_statements = $this->accounting_model->get_all_bank_statements($entreprise_id);
            $bank_accounts = $this->bank_accounts_model->get_entreprise_bank_accounts($entreprise_id);
            $bank_account_list = '';
            foreach ($bank_accounts as $key => $value) {
                $this->data->bank_accounts[$value->id] = $bank_accounts[$value->id] = $bank_accounts[$key];
                $bank_account_list .= $value->id . ':' . $value->label . ';';
            }

            $this->data->bank_account_list = substr($bank_account_list, 0, -1);

            // Jggrid chunk

            $bs = '<?xml version="1.0" encoding="utf-8"?>';
            $bs .= "<rows>";
            foreach ($bank_statements as $key) {
                $bs .= "<row>";
                $bs .= "<cell  name=\"id\">" . $key->id . "</cell>";  // date 
                $bs .= "<cell  name=\"label\">" . $key->label . "</cell>";  // date 
                $bs .= "<cell  name=\"date\">" . date('d-m-Y', $key->date) . "</cell>";  // description 
                $bs .= "<cell  name=\"ammount\">" . number_format($key->ammount, 2, '.', '') . "</cell>";                   // Income type id
                $bs .= "<cell  name=\"description\">" . $key->description . "</cell>";  // Ammount / Ht
                $bs .= "<cell  name=\"bank_account\">" . $bank_accounts[$key->bank_account_id]->label . "</cell>";                   // Tva
                $bs .= "</row>";
            }
            $bs .= "</rows>";
            $this->data->bs_xml = $bs;
            $this->template->build('tpl/bank_statements/overview_view.php', $this->data);
        }
    }

    public function add() {

        $entreprise_id = $this->current_entreprise;

        $this->data->bank_statements = $bank_statements = $this->accounting_model->get_all_bank_statements($entreprise_id);
        $this->data->expenditure_type = $this->accounting_model->get_income_type();

        if ($this->form_validation->run('incomes') !== FALSE) {
            if ($this->input->post('bank_account_id'))
                $expenditure_type_id = $this->input->post('bank_account_id');
            else
                $expenditure_type_id = NULL;

            $data = array(
                'income_type_id' => $this->input->post('income_type_id'),
                'client_id' => $this->input->post('client_id'),
                'description' => $this->input->post('description'),
                'date' => $this->input->post('date'),
                'ht' => $this->input->post('ht'),
                'tva' => $this->input->post('tva'),
                'file_path' => $this->input->post('file_path'),
                'description' => $this->input->post('description')
            );

            if ($this->accounting_model->add_new_income($data)) {
                $this->session->set_flashdata('success', lang('success_message'));
                redirect('accounting/incomes/');
            } else {
                $this->session->set_flashdata('error', lang('error_message'));
                redirect('accounting/incomes/');
            }
        } else {

            foreach ($this->config->item('incomes') as $validation) {
                $repopulate->{$validation['field']} = set_value($validation['field']);
            }
            $this->data->repopulate = & $repopulate;
        }

        (is_ajax()) ? $this->template->set_layout(FALSE) : '';

        $this->template->build('tpl/incomes/create_view', $this->data);
    }

    public function upload_attachment() {

        $config['upload_path'] = BNC_DATA . 'expenditures_attachments';
        $config['allowed_types'] = '*';
        $config['max_size'] = '2048';
        $config['max_width'] = '1024';
        $this->load->library('upload', $config);
        $msg = "";
        $error = "";
        if (!$this->upload->do_upload()) {
            $error = 'Erreur d\'upload';
            echo json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $msg = $data['upload_data']['file_name'];
            //for security reason, we force to remove all uploaded file
        }
        echo "{";
        echo "error: '" . $error . "',\n";
        echo "filePath: '" . $msg . "'\n";
        echo "}";
    }

    public function upload() {

        $this->load->library('csv');
        $file_name = $this->session->userdata('file_path');
        $file_path = './uploads/' . $file_name;
        $content = utf8_encode(file_get_contents($file_path));
        $lines = explode("\n", $content);
        $this->data->count = count($lines) - 1;
        $this->data->lines = $lines;
        (is_ajax()) ? $this->template->set_layout(FALSE) : '';
        $this->template->build('tpl/bank_statements/import_step1_view', $this->data);
    }

    public function import() {
        if ($_POST) {
            $bank_statement_records = $this->input->post('bank_statements_records');
            $count = $this->input->post('count');
            $ignored_lines = $count - count($bank_statement_records);
            $seperator = $this->input->post('seperator');
            $i = 0;
            foreach ($bank_statement_records as $key => $value) {
                $v = str_replace('"', '', $value);
                if (strpos($value, $seperator) !== false) {
                    $records_data[] = explode($seperator, $v);
                } else {
                    $line_error_number = $ignored_lines + $i;
                    $this->session->set_flashdata('error', 'Veuillez choisir le bon seprateur - Erreur ligne ' . $line_error_number);
                    redirect('accounting/bank_statements/import');
                }
                $i++;
            }
            $this->session->set_userdata('step2_records', serialize($records_data));

            $entreprise_id = $this->session->userdata('entreprise_id');
            $this->data->entreprise_bank_accounts = $this->bank_accounts_model->get_entreprise_bank_accounts($entreprise_id);
            $this->data->records_data = $records_data;
            (is_ajax()) ? $this->template->set_layout(FALSE) : '';
            $this->template->build('tpl/bank_statements/import_step2_view', $this->data);
        }
        else
            redirect('accounting/bank_statements/upload');
    }

    public function export() {

        if ($_POST) {
            $this->session->set_userdata('bank_account_id', $this->input->post('bank_account_id'));
            $this->session->set_userdata('label', underscore($this->input->post('label')));
            $decription = $this->input->post('description');
            $date = $this->input->post('date');
            $ammount = $this->input->post('ammount');
            $data = array(
                'bank_account_id' => $this->input->post('bank_account_id'),
                'label' => underscore($this->input->post('label')),
                'description' => $decription,
                'ammount' => $ammount,
                'date' => $date,
            );


            if ($this->accounting_model->add_bulk_bank_statements($data)) {
                $this->session->set_flashdata('success', lang('accounting.bank_statement_add_success'));
            } else {
                $this->session->set_flashdata('error', lang('error_message'));
            }
            redirect('accounting/bank_statements/export');
        }

        $records_data = unserialize($this->session->userdata('step2_records'));
        $this->data->records_data = unserialize($this->session->userdata('step2_records'));
        $expenditures = array();
        $incomees = array();

        foreach ($records_data as $key => $value) {
            if ($value[2] >= 0) {

                $incomes[] = $records_data[$key];
            } else {
                $expenditures[] = $records_data[$key];
            }
        }
        $this->data->bank_account_id = $this->session->userdata('bank_account_id');
        $this->data->label = $this->session->userdata('label');

        $ex_type = '';
        foreach ($this->accounting_model->get_expenditure_type() as $key) {
            $ex_type .= $key->id . ':' . $key->label . ';';
        }
        //FE:FedEx;IN:InTime;TN:TNT;AR:ARAMEX

        $this->data->ex_type = substr($ex_type, 0, -1);
        (is_ajax()) ? $this->template->set_layout(FALSE) : '';

        $in = '<?xml version="1.0" encoding="utf-8"?>';
        $in .= "<rows>";
        foreach ($incomes as $key => $value) {
            $in .= "<row>";
            $in .= "<cell  name=\"date\">" . $value[0] . "</cell>";  // date 
            $in .= "<cell  name=\"description\">" . $value[1] . "</cell>";  // description 
            $in .= "<cell  name=\"type\"></cell>";                   // Income type id
            $in .= "<cell  name=\"ht\">" . abs($value[2]) . "</cell>";  // Ammount / Ht
            $in .= "<cell  name=\"tva\"></cell>";                   // Tva
            $in .= "</row>";
        }
        $in .= "</rows>";
        $this->data->incomes_xml = $in;

        $ex = '<?xml version="1.0" encoding="utf-8"?>';
        $ex .= "<rows>";
        foreach ($expenditures as $key => $value) {
            $ex .= "<row>";
            $ex .= "<cell/>";
            $ex .= "<cell>" . $value[0] . "</cell>";  // date 
            $ex .= "<cell>" . $value[1] . "</cell>";  // description 
            $ex .= "<cell></cell>";                   // Income type id
            $ex .= "<cell>" . abs(str_replace(',', '.', $value[2])) . "</cell>";  // Ammount / Ht
            $ex .= "<cell></cell>";                   // Tva
            $ex .= "<cell></cell>";                   // upload path
            $ex .= "</row>";
        }
        $ex .= "</rows>";
        $this->data->expenditures_xml = $ex;

        $this->template->build('tpl/bank_statements/import_step3_view', $this->data);
    }

    function jqgrid() {
        $this->template->build('jqgrid_test', $this->data);
    }

    function process_data_grid() {

        $page = isset($_POST['page']) ? $_POST['page'] : 1; // get the requested page
        $limit = isset($_POST['rows']) ? $_POST['rows'] : 10; // get how many rows we want to have into the grid
        $sidx = isset($_POST['sidx']) ? $_POST['sidx'] : 'date'; // get index row - i.e. user click to sort
        $sord = isset($_POST['sord']) ? $_POST['sord'] : 'asc'; // get the direction

        $result = $this->accounting_model->jqgrid_get_data();
        $count = count($result);
        if ($count > 0) {
            $total_pages = ceil($count / $limit);    //calculating total number of pages
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;
        $start = $limit * $page - $limit; // do not put $limit*($page - 1)
        $start = ($start < 0) ? 0 : $start;  // make sure that $start is not a negative value
        //dump($sidx,$sord,$start,$limit);
        $r = $this->accounting_model->jqgrid_get_result($sidx, $sord, $start, $limit);
        //dump($r);
        header("Content-type: text/xml;charset=utf-8");
        $s = "<?xml version='1.0' encoding='utf-8'?>";
        $s .= "<rows>";
        $s .= "<page>" . $page . "</page>";
        $s .= "<total>" . $total_pages . "</total>";
        $s .= "<records>" . $count . "</records>";
//label, description, date, ammount
// be sure to put text data in CDATA
        foreach ($r as $key => $value) {
            $s .= "<row id='" . $value->id . "'>";
            $s .= "<cell>" . $value->id . "</cell>";
            $s .= "<cell>" . $value->label . "</cell>";
            $s .= "<cell>" . $value->description . "</cell>";
            $s .= "<cell>" . $value->date . "</cell>";
            $s .= "<cell>" . $value->ammount . "</cell>";
            $s .= "</row>";
        }
        $s .= "</rows>";
        echo $s;
    }

    function update_grid() {
        if ($this->input->post('oper') == 'edit') {
            $id = $this->input->post('id');
            $description = $this->input->post('description');
            $label = $this->input->post('label');
            $date = $this->input->post('date');

            echo $id, ' ', $description, ' ', $date, ' ', $label;
        }
    }

}