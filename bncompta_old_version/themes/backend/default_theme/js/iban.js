// iban.html & iban.js 1.5 - Create or check International Bank Account Numbers
// Copyright (C) 2002-2010, Thomas Günther <tom@toms-cafe.de
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License along
// with this program; if not, write to the Free Software Foundation, Inc.,
// 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.


// Interface functions for iban.html:
// CreateIBAN
// CheckIBAN
// WriteCountrySelectionBar
// WriteCountryFormatTable
// WriteExampleTestTable

// Required tags in iban.html:
// Form             ibanform
//   Selection bar  ibanform.country
//   Input field    ibanform.bank
//   Input field    ibanform.account
//   Input field    ibanform.iban
//   Output field   ibanform.alt_iban
// Image            bban_img
// Image            iban_img

// Used images:
// okay.png         check-mark in ibanform
// error.png        question-mark in ibanform
// blank.png        erase check-mark and question-mark
// arrows_lr.png    arrows in examples table


// Preload images
//var okay_img  = new Image(); okay_img.src  = "okay";
//var error_img = new Image(); error_img.src = "error.png";
//var blank_img = new Image(); blank_img.src = "blank.png";
//var arrow_img = new Image(); arrow_img.src = "arrows_lr.png";
  //                           arrow_img.width = "50";
  //                           arrow_img.height = "20";


// JavaScript Object for country specific iban data.
function Country(name, code, bank_form, acc_form)
{
  // Constructor for Country objects.
  //
  // Arguments:
  //   name      - Name of the country
  //   code      - Country Code from ISO 3166
  //   bank_form - Format of bank/branch code part (e.g. "0 4a 0 ")
  //   acc_form  - Format of account number part (e.g. "0  11  2n")

  this.name      = name;
  this.code      = code;
  this.bank      = Country_decode_format(bank_form);
  this.acc       = Country_decode_format(acc_form);
  this.bank_lng  = Country_calc_length(this.bank);
  this.acc_lng   = Country_calc_length(this.acc);
  this.total_lng = 4 + this.bank_lng + this.acc_lng;
}

function Country_decode_format(form)
{
  var form_list = new Array();
  var parts = form.split(" ");
  for (var i = 0; i < parts.length; ++i)
  {
    var part = parts[i];
    if (part != "")
    {
      var typ = part.charAt(part.length - 1);
      if (typ == "a" || typ == "n")
        part = part.substring(0, part.length - 1);
      else
        typ = "c";
      var lng = parseInt(part);
      form_list[form_list.length] = new Array(lng, typ);
    }
  }
  return form_list;
}

function Country_calc_length(form_list)
{
  var sum = 0;
  for (var i = 0; i < form_list.length; ++i)
    sum += form_list[i][0];
  return sum;
}

// BBAN data from ISO 13616, Country codes from ISO 3166 (www.iso.org).
var iban_data = new Array(
  new Country("Andorra",        "AD", "0  4n 4n", "0  12   0 "),
  new Country("Albania",        "AL", "0  8n 0 ", "0  16   0 "),
  new Country("Austria",        "AT", "0  5n 0 ", "0  11n  0 "),
  new Country("Bosnia and Herzegovina",
                                "BA", "0  3n 3n", "0   8n  2n"),
  new Country("Belgium",        "BE", "0  3n 0 ", "0   7n  2n"),
  new Country("Bulgaria",       "BG", "0  4a 4n", "2n  8   0 "),
  new Country("Switzerland",    "CH", "0  5n 0 ", "0  12   0 "),
  new Country("Cyprus",         "CY", "0  3n 5n", "0  16   0 "),
  new Country("Czech Republic", "CZ", "0  4n 0 ", "0  16n  0 "),
  new Country("Germany",        "DE", "0  8n 0 ", "0  10n  0 "),
  new Country("Denmark",        "DK", "0  4n 0 ", "0   9n  1n"),
  new Country("Estonia",        "EE", "0  2n 0 ", "2n 11n  1n"),
  new Country("Spain",          "ES", "0  4n 4n", "2n 10n  0 "),
  new Country("Finland",        "FI", "0  6n 0 ", "0   7n  1n"),
  new Country("Faroe Islands",  "FO", "0  4n 0 ", "0   9n  1n"),
  new Country("France",         "FR", "0  5n 5n", "0  11   2n"),
  new Country("United Kingdom", "GB", "0  4a 6n", "0   8n  0 "),
  new Country("Georgia",        "GE", "0  2a 0 ", "0  16n  0 "),
  new Country("Gibraltar",      "GI", "0  4a 0 ", "0  15   0 "),
  new Country("Greenland",      "GL", "0  4n 0 ", "0   9n  1n"),
  new Country("Greece",         "GR", "0  3n 4n", "0  16   0 "),
  new Country("Croatia",        "HR", "0  7n 0 ", "0  10n  0 "),
  new Country("Hungary",        "HU", "0  3n 4n", "1n 15n  1n"),
  new Country("Ireland",        "IE", "0  4a 6n", "0   8n  0 "),
  new Country("Israel",         "IL", "0  3n 3n", "0  13n  0 "),
  new Country("Iceland",        "IS", "0  4n 0 ", "2n 16n  0 "),
  new Country("Italy",          "IT", "1a 5n 5n", "0  12   0 "),
  new Country("Kuwait",         "KW", "0  4a 0 ", "0  22   0 "),
  new Country("Kazakhstan",     "KZ", "0  3n 0 ", "0  13   0 "),
  new Country("Lebanon",        "LB", "0  4n 0 ", "0  20   0 "),
  new Country("Liechtenstein",  "LI", "0  5n 0 ", "0  12   0 "),
  new Country("Lithuania",      "LT", "0  5n 0 ", "0  11n  0 "),
  new Country("Luxembourg",     "LU", "0  3n 0 ", "0  13   0 "),
  new Country("Latvia",         "LV", "0  4a 0 ", "0  13   0 "),
  new Country("Monaco",         "MC", "0  5n 5n", "0  11   2n"),
  new Country("Montenegro",     "ME", "0  3n 0 ", "0  13n  2n"),
  new Country("Macedonia, Former Yugoslav Republic of",
                                "MK", "0  3n 0 ", "0  10   2n"),
  new Country("Mauritania",     "MR", "0  5n 5n", "0  11n  2n"),
  new Country("Malta",          "MT", "0  4a 5n", "0  18   0 "),
  new Country("Mauritius",      "MU", "0  4a 4n", "0  15n  3a"),
  new Country("Netherlands",    "NL", "0  4a 0 ", "0  10n  0 "),
  new Country("Norway",         "NO", "0  4n 0 ", "0   6n  1n"),
  new Country("Poland",         "PL", "0  8n 0 ", "0  16n  0 "),
  new Country("Portugal",       "PT", "0  4n 4n", "0  11n  2n"),
  new Country("Romania",        "RO", "0  4a 0 ", "0  16   0 "),
  new Country("Serbia",         "RS", "0  3n 0 ", "0  13n  2n"),
  new Country("Saudi Arabia",   "SA", "0  2n 0 ", "0  18   0 "),
  new Country("Sweden",         "SE", "0  3n 0 ", "0  16n  1n"),
  new Country("Slovenia",       "SI", "0  5n 0 ", "0   8n  2n"),
  new Country("Slovak Republic",
                                "SK", "0  4n 0 ", "0  16n  0 "),
  new Country("San Marino",     "SM", "1a 5n 5n", "0  12   0 "),
  new Country("Tunisia",        "TN", "0  2n 3n", "0  13n  2n"),
  new Country("Turkey",         "TR", "0  5n 0 ", "1  16   0 "));

// Search the country code in the iban_data list.
function CountryData(code)
{
  for (var i = 0; i < iban_data.length; ++i)
    if (iban_data[i].code == code)
      return iban_data[i];
  return null;
}

// Modulo 97 for huge numbers given as digit strings.
function mod97(digit_string)
{
  var m = 0;
  for (var i = 0; i < digit_string.length; ++i)
    m = (m * 10 + parseInt(digit_string.charAt(i))) % 97;
  return m;
}

// Convert a capital letter into digits: A -> 10 ... Z -> 35 (ISO 13616).
function capital2digits(ch)
{
  var capitals = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  for (var i = 0; i < capitals.length; ++i)
    if (ch == capitals.charAt(i))
      break;
  return i + 10;
}

// Fill the string with leading zeros until length is reached.
function fill0(s, l)
{
  while (s.length < l)
    s = "0" + s;
  return s;
}

// Compare two strings respecting german umlauts.
function strcmp(s1, s2)
{
  var chars = "AaÄäBbCcDdEeFfGgHhIiJjKkLlMmNnOoÖöPpQqRrSsßTtUuÜüVvWwXxYyZz";
  var lng = (s1.length < s2.length) ? s1.length : s2.length;
  for (var i = 0; i < lng; ++i)
  {
    var d = chars.indexOf(s1.charAt(i)) - chars.indexOf(s2.charAt(i));
    if (d != 0)
      return d;
  }
  return s1.length - s2.length;
}

// Create an index table of the iban_data list sorted by country names.
function CountryIndexTable()
{
  var tab = new Array();
  var i, j, t;
  for (i = 0; i < iban_data.length; ++i)
    tab[i] = i;
  for (i = tab.length - 1; i > 0; --i)
    for (j = 0; j < i; ++j)
      if (strcmp(iban_data[tab[j]].name, iban_data[tab[j+1]].name) > 0)
        t = tab[j], tab[j] = tab[j+1], tab[j+1] = t;
  return tab;
}

// Calculate 2-digit checksum of an IBAN.
function ChecksumIBAN(iban)
{
  var code     = iban.substring(0, 2);
  var checksum = iban.substring(2, 4);
  var bban     = iban.substring(4);

  // Assemble digit string
  var digits = "";
  for (var i = 0; i < bban.length; ++i)
  {
    var ch = bban.charAt(i).toUpperCase();
    if ("0" <= ch && ch <= "9")
      digits += ch;
    else
      digits += capital2digits(ch);
  }
  for (var i = 0; i < code.length; ++i)
  {
    var ch = code.charAt(i);
    digits += capital2digits(ch);
  }
  digits += checksum;

  // Calculate checksum
  checksum = 98 - mod97(digits);
  return fill0("" + checksum, 2);
}

// Fill the account number part of IBAN with leading zeros.
function FillAccount(country, account)
{
  return fill0(account, country.acc_lng);
}

// Check if syntax of the part of IBAN is invalid.
function InvalidPart(form_list, iban_part)
{
  for (var f = 0; f < form_list.length; ++f)
  {
    var lng = form_list[f][0], typ = form_list[f][1];
    if (lng > iban_part.length)
      lng = iban_part.length;
    for (var i = 0; i < lng; ++i)
    {
      var ch = iban_part.charAt(i);
      var a = ("A" <= ch && ch <= "Z");
      var n = ("0" <= ch && ch <= "9");
      var c = n || a || ("a" <= ch && ch <= "z");
      if ((!c && typ == "c") || (!a && typ == "a") || (!n && typ == "n"))
        return true;
    }
    iban_part = iban_part.substring(lng);
  }
  return false;
}

// Check if length of the bank/branch code part of IBAN is invalid.
function InvalidBankLength(country, bank)
{
  return (bank.length != country.bank_lng);
}

// Check if syntax of the bank/branch code part of IBAN is invalid.
function InvalidBank(country, bank)
{
  return (InvalidBankLength(country, bank) ||
          InvalidPart(country.bank, bank));
}

// Check if length of the account number part of IBAN is invalid.
function InvalidAccountLength(country, account)
{
  return (account.length < 1 || account.length > country.acc_lng);
}

// Check if syntax of the account number part of IBAN is invalid.
function InvalidAccount(country, account)
{
  return (InvalidAccountLength(country, account) ||
          InvalidPart(country.acc, FillAccount(country, account)));
}

// Check if length of IBAN is invalid.
function InvalidIBANlength(country, iban)
{
  return (iban.length != country.total_lng);
}

// Convert iban from intern value to string format (IBAN XXXX XXXX ...).
function extern(intern)
{
  var s = "IBAN";
  for (var i = 0; i < intern.length; ++i)
  {
    if (i % 4 == 0)
      s += " ";
    s += intern.charAt(i);
  }
  return s;
}

// Convert iban from string format to intern value.
function intern(extern)
{
  if (extern.substring(0, 4) == "IBAN")
    extern = extern.substring(4);
  var s = "";
  for (var i = 0; i < extern.length; ++i)
    if (extern.charAt(i) != " ")
      s += extern.charAt(i);
  return s;
}

// Calculate the checksum and assemble the IBAN.
function CalcIBAN(country, bank, account)
{
  var fill_acc = FillAccount(country, account);
  var checksum = ChecksumIBAN(country.code + "00" + bank + fill_acc);
  return country.code + checksum + bank + fill_acc;
}

function CalcAltIBAN(country, bank, account)
{
  var fill_acc = FillAccount(country, account);
  var checksum = ChecksumIBAN(country.code + "00" + bank + fill_acc);
  checksum = fill0("" + mod97(checksum), 2);
  return country.code + checksum + bank + fill_acc;
}

// Check the checksum of an IBAN.
function IBANokay(iban)
{
  return ChecksumIBAN(iban) == "97";
}

// Check the input, calculate the checksum and assemble the IBAN.
function CreateIBAN()
{
  var form = document.ibanform;
  var code = form.country.options[form.country.selectedIndex].value;
  var bank = intern(form.bank.value);
  var account = intern(form.account.value);
  var country = CountryData(code);

  var err = null, err_focus = null;
  if (country == null)
  {
    err = _("Unknown Country Code: ") + code;
    err_focus = form.country;
  }
  else if (InvalidBankLength(country, bank))
  {
    err = _("Bank/Branch Code length ") + bank.length +
          _(" is not correct for ") + country.name +
          " (" + country.bank_lng + ")";
    err_focus = form.bank;
  }
  else if (InvalidBank(country, bank))
  {
    err = _("Bank/Branch Code ") + bank + _(" is not correct for ") +
          country.name;
    err_focus = form.bank;
  }
  else if (InvalidAccountLength(country, account))
  {
    err = _("Account Number length ") + account.length +
          _(" is not correct for ") + country.name +
          " (" + country.acc_lng + ")";
    err_focus = form.account;
  }
  else if (InvalidAccount(country, account))
  {
    err = _("Account Number ") + account + _(" is not correct for ") +
          country.name;
    err_focus = form.account;
  }

  if (err)
  {
    // Set error image on BBAN side
    //document.bban_img.src = error_img.src;
    //document.iban_img.src = blank_img.src;
    // Clear destination fields, set focus to wrong field
    //form.iban.value = "";
    //form.alt_iban.value = "";
    err_focus.focus();

    // Show message box with error message
    alert(err);
  }
  else
  {
    // Set okay image on IBAN side
    //document.iban_img.src = okay_img.src;
    //document.bban_img.src = blank_img.src;

    // Calculate IBAN, write results in form fields
    form.bank.value = bank;
    form.account.value = FillAccount(country, account);
    form.iban.value = extern(CalcIBAN(country, bank, account));

    // Calculate alternative IBAN, write warning if not the same
    //form.alt_iban.value = extern(CalcAltIBAN(country, bank, account));
    //if (form.alt_iban.value != form.iban.value)
    //  form.alt_iban.value += " (*)";
    //else
    //  form.alt_iban.value = "";

    // Check for dispensable global variables in debug modus
    if (debug_output)
      debug_check_vars();
  }
}

// Check the syntax and the checksum of the IBAN.
function CheckIBAN()
{
  var form = document.ibanform;
  var iban = intern(form.iban.value);

  var code     = iban.substring(0, 2);
  var checksum = iban.substring(2, 4);
  var bban     = iban.substring(4);
  var country  = CountryData(code);

  var err = null;
  if (country == null)
    err = _("Unknown Country Code: ") + code;
  else if (InvalidIBANlength(country, iban))
    err = _("IBAN length ") + iban.length + _(" is not correct for ") +
          country.name + " (" + country.total_lng + ")";
  else
  {
    var bank_lng = country.bank_lng;
    var bank     = bban.substring(0, bank_lng);
    var account  = bban.substring(bank_lng);

    if (InvalidBank(country, bank))
      err = _("Bank/Branch Code ") + bank + _(" is not correct for ") +
            country.name;
    else if (InvalidAccount(country, account))
      err = _("Account Number ") + account + _(" is not correct for ") +
            country.name;
    else if (!IBANokay(iban))
      err = _("Checksum of IBAN incorrect");
  }

  if (err)
  {
    // Set error image on IBAN side
    document.iban_img.src = error_img.src;
    document.bban_img.src = blank_img.src;

    // Clear destination fields, set focus to wrong field
    form.country.selectedIndex = 0;
    form.bank.value = "";
    form.account.value = "";
    form.alt_iban.value = "";
    form.iban.focus();

    // Show message box with error message
    alert(err);
  }
  else
  {
    // Set okay image on BBAN side
    //document.bban_img.src = okay_img.src;
   // document.iban_img.src = blank_img.src;

    // Write results in form fields
    form.iban.value = extern(iban);
    for (var i = form.country.options.length - 1; i > 0; --i)
      if (form.country.options[i].value == code)
        break;
    form.country.selectedIndex = i;
    form.bank.value = bank;
    form.account.value = account;

    // Calculate alternative IBAN, write warning if not the same
    //form.alt_iban.value = extern(CalcAltIBAN(country, bank, account));
    //if (form.alt_iban.value != form.iban.value)
    //  form.alt_iban.value += " (*)";
    //else
    //  form.alt_iban.value = "";

    // Check for dispensable global variables in debug modus
    if (debug_output)
      debug_check_vars();
  }
}

// Write the selection bar into the form.
function WriteCountrySelectionBar()
{
  document.write('<select name="country" size="1">');
  document.write('<option value="??">&nbsp;</option>');
  var tab = CountryIndexTable();
  for (var i = 0; i < tab.length; ++i)
  {
    var country = iban_data[tab[i]];
    document.write('<option value="' + country.code + '">' +
                   country.name + ' (' + country.code + ')</option>');
  }
  document.write('</select>');
}

// Write a table with the country specific iban format.
function WriteCountryFormatTable()
{
  document.write('<table bgcolor="#99FFCC" width="100%" border="4">' +
                 ' <tr>' +
                 '  <th rowspan="2">&nbsp;</th>' +
                 '  <th rowspan="2">' + _("Country") + '<BR />Code</th>' +
                 '  <th colspan="3">' + _("Bank/Branch Code") + '</th>' +
                 '  <th colspan="3">' + _("Account Number") + '</th>' +
                 ' </tr>' +
                 ' <tr>' +
                 '  <th>' + _("check1") + '</th><th>' + _("bank") + '</th>' +
                 '  <th>' + _("branch") + '</th><th>' + _("check2") + '</th>' +
                 '  <th>' + _("number") + '</th><th>' + _("check3") + '</th>' +
                 ' </tr>');
  var tab = CountryIndexTable();
  for (var i = 0; i < tab.length; ++i)
  {
    var country = iban_data[tab[i]];
    document.write(' <tr>' +
                   '  <td>' + country.name + '</td>' +
                   '  <td align="center">' + country.code + '</td>');
    for (var f = 0; f < country.bank.length; ++f)
    {
      var lng = country.bank[f][0], typ = country.bank[f][1];
      if (lng > 0)
        document.write('  <td align="center">' + lng + ' ' + typ + '</td>');
      else
        document.write('  <td align="center">-</td>');
    }
    for (var f = 0; f < country.acc.length; ++f)
    {
      var lng = country.acc[f][0], typ = country.acc[f][1];
      if (lng > 0)
        document.write('  <td align="center">' + lng + ' ' + typ + '</td>');
      else
        document.write('  <td align="center">-</td>');
    }
  }
  document.write(' <tr>' +
                 '  <td colspan="2">&nbsp;</td>' +
                 '  <td colspan="8" align="center">' +
                    _("a = A-Z, n = 0-9, c = A-Z/a-z/0-9") +
                 '  </td>' +
                 ' </tr>' +
                 '</table>');
}

// Write a table with iban test data.
function WriteTestTable(data)
{
  document.write('<table bgcolor="#99FFCC" width="100%" border="4">' +
                 ' <tr>' +
                 '  <th>' + _('Country Code') + '</th>' +
                 '  <th>' + _('Bank/Branch Code') + '</th>' +
                 '  <th>' + _('Account Number') + '</th>' +
                 '  <th>&nbsp;</th>' +
                 '  <th>' + _('International Bank Account Number') + '</th>' +
                 '  <th>' + _('Checksum') + '</th>' +
                 ' </tr>');
  for (var i = 0; i < data.length; ++i)
  {
    var code     = data[i][0];
    var bank     = data[i][1];
    var account  = data[i][2];
    var checksum = data[i][3];
    var country  = CountryData(code);
    var iban = "", err = null;

    if (country == null)
      err = _("Unknown Country Code");
    else if (InvalidBank(country, bank))
      err = _("Incorrect Bank/Branch Code");
    else if (InvalidAccount(country, account))
      err = _("Incorrect Account Number");
    else
    {
      iban = CalcIBAN(country, bank, account);

      if (iban.substring(2, 4) != checksum)
      {
        var alt_iban = CalcAltIBAN(country, bank, account);
        if (alt_iban.substring(2, 4) == checksum)
          iban = alt_iban;
      }

      if (iban.substring(0, 2) != code)
        err = _("Country code changed");
      else if (InvalidIBANlength(country, iban))
        err = _("Incorrect IBAN length: ") + iban.length +
              " (" + country.total_lng + ")";
      else
      {
        var bban = iban.substring(4);
        var bank_lng = country.bank_lng;

        if (bban.substring(0, bank_lng) != bank)
          err = _("Bank/Branch Code changed");
        else if (bban.substring(bank_lng) != FillAccount(country, account))
          err = _("Account Number changed");
        else if (!IBANokay(iban))
          err = _("Incorrect checksum");
        else if (iban.substring(2, 4) != checksum)
          err = _("Checksum changed");
      }
    }
    document.write(' <tr>' +
                   '  <td align="center">' + code + '</td>' +
                   '  <td align="center">' + bank + '</td>' +
                   '  <td align="center">' + account + '</td>');
    if (err)
      document.write('  <td colspan="3" align="center">' + err + '</td>');
    else
      document.write('  <td align="center">' +
                     '   <img src="' + arrow_img.src + '"' +
                     '        width="' + arrow_img.width + '"' +
                     '        height="' + arrow_img.height +'"' +
                     '        border="0" alt="<==>" />' +
                     '  </td>' +
                     '  <td align="center">' + extern(iban) + '</td>' +
                     '  <td align="center">' + checksum + '</td>');
    document.write(' </tr>');
  }
  document.write('</table>');
}

// Write a table with an example for each country.
function WriteExampleTestTable()
{
  WriteTestTable(examples);

  // Write table with test data only in debug modus
  if (debug_output)
    WriteTestTable(test_data);
}

// Examples of IBANs for each country.
var examples = new Array(
  new Array("AD", "00012030",    "200359100100",         "12"),
  new Array("AL", "21211009",    "0000000235698741",     "47"),
  new Array("AT", "19043",       "00234573201",          "61"),
  new Array("BA", "129007",      "9401028494",           "39"),
  new Array("BE", "539",         "007547034",            "68"),
  new Array("BG", "BNBG9661",    "1020345678",           "80"),
  new Array("CH", "00762",       "011623852957",         "93"),
  new Array("CY", "00200128",    "0000001200527600",     "17"),
  new Array("CZ", "0800",        "0000192000145399",     "65"),
  new Array("DE", "37040044",    "0532013000",           "89"),
  new Array("DK", "0040",        "0440116243",           "50"),
  new Array("EE", "22",          "00221020145685",       "38"),
  new Array("ES", "21000418",    "450200051332",         "91"),
  new Array("FI", "123456",      "00000785",             "21"),
  new Array("FO", "6460",        "0001631634",           "62"),
  new Array("FR", "2004101005",  "0500013M02606",        "14"),
  new Array("GB", "NWBK601613",  "31926819",             "29"),
  new Array("GE", "NB",          "0000000101904917",     "29"),
  new Array("GI", "NWBK",        "000000007099453",      "75"),
  new Array("GL", "6471",        "0001000206",           "89"),
  new Array("GR", "0110125",     "0000000012300695",     "16"),
  new Array("HR", "1001005",     "1863000160",           "12"),
  new Array("HU", "1177301",     "61111101800000000",    "42"),
  new Array("IE", "AIBK931152",  "12345678",             "29"),
  new Array("IL", "010800",      "0000099999999",        "62"),
  new Array("IS", "0159",        "260076545510730339",   "14"),
  new Array("IT", "X0542811101", "000000123456",         "60"),
  new Array("KW", "CBKU",        "0000000000001234560101", "81"),
  new Array("KZ", "125",         "KZT5004100100",        "86"),
  new Array("LB", "0999",        "00000001001901229114", "62"),
  new Array("LI", "08810",       "0002324013AA",         "21"),
  new Array("LT", "10000",       "11101001000",          "12"),
  new Array("LU", "001",         "9400644750000",        "28"),
  new Array("LV", "BANK",        "0000435195001",        "80"),
  new Array("MC", "1273900070",  "0011111000h79",        "11"),
  new Array("ME", "505",         "000012345678951",      "25"),
  new Array("MK", "250",         "120000058984",         "07"),
  new Array("MR", "0002000101",  "0000123456753",        "13"),
  new Array("MT", "MALT01100",   "0012345MTLCAST001S",   "84"),
  new Array("MU", "BOMM0101",    "101030300200000MUR",   "17"),
  new Array("NL", "ABNA",        "0417164300",           "91"),
  new Array("NO", "8601",        "1117947",              "93"),
  new Array("PL", "10901014",    "0000071219812874",     "61"),
  new Array("PT", "00020123",    "1234567890154",        "50"),
  new Array("RO", "AAAA",        "1B31007593840000",     "49"),
  new Array("RS", "260",         "005601001611379",      "35"),
  new Array("SA", "80",          "000000608010167519",   "03"),
  new Array("SE", "500",         "00000058398257466",    "45"),
  new Array("SI", "19100",       "0000123438",           "56"),
  new Array("SK", "1200",        "0000198742637541",     "31"),
  new Array("SM", "U0322509800", "000000270100",         "86"),
  new Array("TN", "10006",       "035183598478831",      "59"),
  new Array("TR", "00061",       "00519786457841326",    "33"));

// Test data for each country.
var test_data = new Array(
  new Array("XY", "1",           "2",                    "33"),
  new Array("AD", "11112222",    "C3C3C3C3C3C3",         "11"),
  new Array("AD", "1111222",     "C3C3C3C3C3C3",         "11"),
  new Array("AD", "X1112222",    "C3C3C3C3C3C3",         "11"),
  new Array("AD", "111@2222",    "C3C3C3C3C3C3",         "11"),
  new Array("AD", "1111X222",    "C3C3C3C3C3C3",         "11"),
  new Array("AD", "1111222@",    "C3C3C3C3C3C3",         "11"),
  new Array("AD", "11112222",    "@3C3C3C3C3C3",         "11"),
  new Array("AD", "11112222",    "C3C3C3C3C3C@",         "11"),
  new Array("AL", "11111111",    "B2B2B2B2B2B2B2B2",     "54"),
  new Array("AL", "1111111",     "B2B2B2B2B2B2B2B2",     "54"),
  new Array("AL", "X1111111",    "B2B2B2B2B2B2B2B2",     "54"),
  new Array("AL", "1111111@",    "B2B2B2B2B2B2B2B2",     "54"),
  new Array("AL", "11111111",    "@2B2B2B2B2B2B2B2",     "54"),
  new Array("AL", "11111111",    "B2B2B2B2B2B2B2B@",     "54"),
  new Array("AT", "11111",       "22222222222",          "17"),
  new Array("AT", "1111",        "22222222222",          "17"),
  new Array("AT", "X1111",       "22222222222",          "17"),
  new Array("AT", "1111@",       "22222222222",          "17"),
  new Array("AT", "11111",       "X2222222222",          "17"),
  new Array("AT", "11111",       "2222222222@",          "17"),
  new Array("BA", "111222",      "3333333344",           "79"),
  new Array("BA", "11122",       "3333333344",           "79"),
  new Array("BA", "X11222",      "3333333344",           "79"),
  new Array("BA", "11@222",      "3333333344",           "79"),
  new Array("BA", "111X22",      "3333333344",           "79"),
  new Array("BA", "11122@",      "3333333344",           "79"),
  new Array("BA", "111222",      "X333333344",           "79"),
  new Array("BA", "111222",      "3333333@44",           "79"),
  new Array("BA", "111222",      "33333333X4",           "79"),
  new Array("BA", "111222",      "333333334@",           "79"),
  new Array("BE", "111",         "222222233",            "93"),
  new Array("BE", "11",          "222222233",            "93"),
  new Array("BE", "X11",         "222222233",            "93"),
  new Array("BE", "11@",         "222222233",            "93"),
  new Array("BE", "111",         "X22222233",            "93"),
  new Array("BE", "111",         "222222@33",            "93"),
  new Array("BE", "111",         "2222222X3",            "93"),
  new Array("BE", "111",         "22222223@",            "93"),
  new Array("BG", "AAAA2222",    "33D4D4D4D4",           "20"),
  new Array("BG", "AAAA222",     "33D4D4D4D4",           "20"),
  new Array("BG", "8AAA2222",    "33D4D4D4D4",           "20"),
  new Array("BG", "AAA@2222",    "33D4D4D4D4",           "20"),
  new Array("BG", "AAAAX222",    "33D4D4D4D4",           "20"),
  new Array("BG", "AAAA222@",    "33D4D4D4D4",           "20"),
  new Array("BG", "AAAA2222",    "X3D4D4D4D4",           "20"),
  new Array("BG", "AAAA2222",    "3@D4D4D4D4",           "20"),
  new Array("BG", "AAAA2222",    "33@4D4D4D4",           "20"),
  new Array("BG", "AAAA2222",    "33D4D4D4D@",           "20"),
  new Array("CH", "11111",       "B2B2B2B2B2B2",         "60"),
  new Array("CH", "1111",        "B2B2B2B2B2B2",         "60"),
  new Array("CH", "X1111",       "B2B2B2B2B2B2",         "60"),
  new Array("CH", "1111@",       "B2B2B2B2B2B2",         "60"),
  new Array("CH", "11111",       "@2B2B2B2B2B2",         "60"),
  new Array("CH", "11111",       "B2B2B2B2B2B@",         "60"),
  new Array("CY", "11122222",    "C3C3C3C3C3C3C3C3",     "29"),
  new Array("CY", "1112222",     "C3C3C3C3C3C3C3C3",     "29"),
  new Array("CY", "X1122222",    "C3C3C3C3C3C3C3C3",     "29"),
  new Array("CY", "11@22222",    "C3C3C3C3C3C3C3C3",     "29"),
  new Array("CY", "111X2222",    "C3C3C3C3C3C3C3C3",     "29"),
  new Array("CY", "1112222@",    "C3C3C3C3C3C3C3C3",     "29"),
  new Array("CY", "11122222",    "@3C3C3C3C3C3C3C3",     "29"),
  new Array("CY", "11122222",    "C3C3C3C3C3C3C3C@",     "29"),
  new Array("CZ", "1111",        "2222222222222222",     "68"),
  new Array("CZ", "111",         "2222222222222222",     "68"),
  new Array("CZ", "X111",        "2222222222222222",     "68"),
  new Array("CZ", "111@",        "2222222222222222",     "68"),
  new Array("CZ", "1111",        "X222222222222222",     "68"),
  new Array("CZ", "1111",        "222222222222222@",     "68"),
  new Array("DE", "11111111",    "2222222222",           "16"),
  new Array("DE", "1111111",     "2222222222",           "16"),
  new Array("DE", "X1111111",    "2222222222",           "16"),
  new Array("DE", "1111111@",    "2222222222",           "16"),
  new Array("DE", "11111111",    "X222222222",           "16"),
  new Array("DE", "11111111",    "222222222@",           "16"),
  new Array("DK", "1111",        "2222222223",           "79"),
  new Array("DK", "111",         "2222222223",           "79"),
  new Array("DK", "X111",        "2222222223",           "79"),
  new Array("DK", "111@",        "2222222223",           "79"),
  new Array("DK", "1111",        "X222222223",           "79"),
  new Array("DK", "1111",        "22222222@3",           "79"),
  new Array("DK", "1111",        "222222222X",           "79"),
  new Array("EE", "11",          "22333333333334",       "96"),
  new Array("EE", "1",           "22333333333334",       "96"),
  new Array("EE", "X1",          "22333333333334",       "96"),
  new Array("EE", "1@",          "22333333333334",       "96"),
  new Array("EE", "11",          "X2333333333334",       "96"),
  new Array("EE", "11",          "2@333333333334",       "96"),
  new Array("EE", "11",          "22X33333333334",       "96"),
  new Array("EE", "11",          "223333333333@4",       "96"),
  new Array("EE", "11",          "2233333333333X",       "96"),
  new Array("ES", "11112222",    "334444444444",         "71"),
  new Array("ES", "1111222",     "334444444444",         "71"),
  new Array("ES", "X1112222",    "334444444444",         "71"),
  new Array("ES", "111@2222",    "334444444444",         "71"),
  new Array("ES", "1111X222",    "334444444444",         "71"),
  new Array("ES", "1111222@",    "334444444444",         "71"),
  new Array("ES", "11112222",    "X34444444444",         "71"),
  new Array("ES", "11112222",    "3@4444444444",         "71"),
  new Array("ES", "11112222",    "33X444444444",         "71"),
  new Array("ES", "11112222",    "33444444444@",         "71"),
  new Array("FI", "111111",      "22222223",             "68"),
  new Array("FI", "11111",       "22222223",             "68"),
  new Array("FI", "X11111",      "22222223",             "68"),
  new Array("FI", "11111@",      "22222223",             "68"),
  new Array("FI", "111111",      "X2222223",             "68"),
  new Array("FI", "111111",      "222222@3",             "68"),
  new Array("FI", "111111",      "2222222X",             "68"),
  new Array("FO", "1111",        "2222222223",           "49"),
  new Array("FO", "111",         "2222222223",           "49"),
  new Array("FO", "X111",        "2222222223",           "49"),
  new Array("FO", "111@",        "2222222223",           "49"),
  new Array("FO", "1111",        "X222222223",           "49"),
  new Array("FO", "1111",        "22222222@3",           "49"),
  new Array("FO", "1111",        "222222222X",           "49"),
  new Array("FR", "1111122222",  "C3C3C3C3C3C44",        "44"),
  new Array("FR", "111112222",   "C3C3C3C3C3C44",        "44"),
  new Array("FR", "X111122222",  "C3C3C3C3C3C44",        "44"),
  new Array("FR", "1111@22222",  "C3C3C3C3C3C44",        "44"),
  new Array("FR", "11111X2222",  "C3C3C3C3C3C44",        "44"),
  new Array("FR", "111112222@",  "C3C3C3C3C3C44",        "44"),
  new Array("FR", "1111122222",  "@3C3C3C3C3C44",        "44"),
  new Array("FR", "1111122222",  "C3C3C3C3C3@44",        "44"),
  new Array("FR", "1111122222",  "C3C3C3C3C3CX4",        "44"),
  new Array("FR", "1111122222",  "C3C3C3C3C3C4@",        "44"),
  new Array("GB", "AAAA222222",  "33333333",             "45"),
  new Array("GB", "AAAA22222",   "33333333",             "45"),
  new Array("GB", "8AAA222222",  "33333333",             "45"),
  new Array("GB", "AAA@222222",  "33333333",             "45"),
  new Array("GB", "AAAAX22222",  "33333333",             "45"),
  new Array("GB", "AAAA22222@",  "33333333",             "45"),
  new Array("GB", "AAAA222222",  "X3333333",             "45"),
  new Array("GB", "AAAA222222",  "3333333@",             "45"),
  new Array("GE", "AA",          "2222222222222222",     "98"),
  new Array("GE", "A",           "2222222222222222",     "98"),
  new Array("GE", "8A",          "2222222222222222",     "98"),
  new Array("GE", "A@",          "2222222222222222",     "98"),
  new Array("GE", "AA",          "X222222222222222",     "98"),
  new Array("GE", "AA",          "222222222222222@",     "98"),
  new Array("GI", "AAAA",        "B2B2B2B2B2B2B2B",      "72"),
  new Array("GI", "AAA",         "B2B2B2B2B2B2B2B",      "72"),
  new Array("GI", "8AAA",        "B2B2B2B2B2B2B2B",      "72"),
  new Array("GI", "AAA@",        "B2B2B2B2B2B2B2B",      "72"),
  new Array("GI", "AAAA",        "@2B2B2B2B2B2B2B",      "72"),
  new Array("GI", "AAAA",        "B2B2B2B2B2B2B2@",      "72"),
  new Array("GL", "1111",        "2222222223",           "49"),
  new Array("GL", "111",         "2222222223",           "49"),
  new Array("GL", "X111",        "2222222223",           "49"),
  new Array("GL", "111@",        "2222222223",           "49"),
  new Array("GL", "1111",        "X222222223",           "49"),
  new Array("GL", "1111",        "22222222@3",           "49"),
  new Array("GL", "1111",        "222222222X",           "49"),
  new Array("GR", "1112222",     "C3C3C3C3C3C3C3C3",     "61"),
  new Array("GR", "111222",      "C3C3C3C3C3C3C3C3",     "61"),
  new Array("GR", "X112222",     "C3C3C3C3C3C3C3C3",     "61"),
  new Array("GR", "11@2222",     "C3C3C3C3C3C3C3C3",     "61"),
  new Array("GR", "111X222",     "C3C3C3C3C3C3C3C3",     "61"),
  new Array("GR", "111222@",     "C3C3C3C3C3C3C3C3",     "61"),
  new Array("GR", "1112222",     "@3C3C3C3C3C3C3C3",     "61"),
  new Array("GR", "1112222",     "C3C3C3C3C3C3C3C@",     "61"),
  new Array("HR", "1111111",     "2222222222",           "94"),
  new Array("HR", "111111",      "2222222222",           "94"),
  new Array("HR", "X111111",     "2222222222",           "94"),
  new Array("HR", "111111@",     "2222222222",           "94"),
  new Array("HR", "1111111",     "X222222222",           "94"),
  new Array("HR", "1111111",     "222222222@",           "94"),
  new Array("HU", "1112222",     "34444444444444445",    "35"),
  new Array("HU", "111222",      "34444444444444445",    "35"),
  new Array("HU", "X112222",     "34444444444444445",    "35"),
  new Array("HU", "11@2222",     "34444444444444445",    "35"),
  new Array("HU", "111X222",     "34444444444444445",    "35"),
  new Array("HU", "111222@",     "34444444444444445",    "35"),
  new Array("HU", "1112222",     "X4444444444444445",    "35"),
  new Array("HU", "1112222",     "3X444444444444445",    "35"),
  new Array("HU", "1112222",     "344444444444444@5",    "35"),
  new Array("HU", "1112222",     "3444444444444444X",    "35"),
  new Array("IE", "AAAA222222",  "33333333",             "18"),
  new Array("IE", "AAAA22222",   "33333333",             "18"),
  new Array("IE", "8AAA222222",  "33333333",             "18"),
  new Array("IE", "AAA@222222",  "33333333",             "18"),
  new Array("IE", "AAAAX22222",  "33333333",             "18"),
  new Array("IE", "AAAA22222@",  "33333333",             "18"),
  new Array("IE", "AAAA222222",  "X3333333",             "18"),
  new Array("IE", "AAAA222222",  "3333333@",             "18"),
  new Array("IL", "111222",      "3333333344",           "64"),
  new Array("IL", "11122",       "3333333344",           "64"),
  new Array("IL", "X11222",      "3333333344",           "64"),
  new Array("IL", "11@222",      "3333333344",           "64"),
  new Array("IL", "111X22",      "3333333344",           "64"),
  new Array("IL", "11122@",      "3333333344",           "64"),
  new Array("IL", "111222",      "X333333333333",        "64"),
  new Array("IL", "111222",      "333333333333@",        "64"),
  new Array("IS", "1111",        "223333333333333333",   "12"),
  new Array("IS", "111",         "223333333333333333",   "12"),
  new Array("IS", "X111",        "223333333333333333",   "12"),
  new Array("IS", "111@",        "223333333333333333",   "12"),
  new Array("IS", "1111",        "X23333333333333333",   "12"),
  new Array("IS", "1111",        "2@3333333333333333",   "12"),
  new Array("IS", "1111",        "22X333333333333333",   "12"),
  new Array("IS", "1111",        "22333333333333333@",   "12"),
  new Array("IT", "A2222233333", "D4D4D4D4D4D4",         "43"),
  new Array("IT", "A222223333",  "D4D4D4D4D4D4",         "43"),
  new Array("IT", "82222233333", "D4D4D4D4D4D4",         "43"),
  new Array("IT", "AX222233333", "D4D4D4D4D4D4",         "43"),
  new Array("IT", "A2222@33333", "D4D4D4D4D4D4",         "43"),
  new Array("IT", "A22222X3333", "D4D4D4D4D4D4",         "43"),
  new Array("IT", "A222223333@", "D4D4D4D4D4D4",         "43"),
  new Array("IT", "A2222233333", "@4D4D4D4D4D4",         "43"),
  new Array("IT", "A2222233333", "D4D4D4D4D4D@",         "43"),
  new Array("KW", "AAAA",        "B2B2B2B2B2B2B2B2B2B2B2", "93"),
  new Array("KW", "AAA",         "B2B2B2B2B2B2B2B2B2B2B2", "93"),
  new Array("KW", "8AAA",        "B2B2B2B2B2B2B2B2B2B2B2", "93"),
  new Array("KW", "AAA@",        "B2B2B2B2B2B2B2B2B2B2B2", "93"),
  new Array("KW", "AAAA",        "@2B2B2B2B2B2B2B2B2B2B2", "93"),
  new Array("KW", "AAAA",        "B2B2B2B2B2B2B2B2B2B2B@", "93"),
  new Array("KZ", "111",         "B2B2B2B2B2B2B",        "21"),
  new Array("KZ", "11",          "B2B2B2B2B2B2B",        "21"),
  new Array("KZ", "X11",         "B2B2B2B2B2B2B",        "21"),
  new Array("KZ", "11@",         "B2B2B2B2B2B2B",        "21"),
  new Array("KZ", "111",         "@2B2B2B2B2B2B",        "21"),
  new Array("KZ", "111",         "B2B2B2B2B2B2@",        "21"),
  new Array("LB", "1111",        "B2B2B2B2B2B2B2B2B2B2", "88"),
  new Array("LB", "111",         "B2B2B2B2B2B2B2B2B2B2", "88"),
  new Array("LB", "X111",        "B2B2B2B2B2B2B2B2B2B2", "88"),
  new Array("LB", "111@",        "B2B2B2B2B2B2B2B2B2B2", "88"),
  new Array("LB", "1111",        "@2B2B2B2B2B2B2B2B2B2", "88"),
  new Array("LB", "1111",        "B2B2B2B2B2B2B2B2B2B@", "88"),
  new Array("LI", "11111",       "B2B2B2B2B2B2",         "73"),
  new Array("LI", "1111",        "B2B2B2B2B2B2",         "73"),
  new Array("LI", "X1111",       "B2B2B2B2B2B2",         "73"),
  new Array("LI", "1111@",       "B2B2B2B2B2B2",         "73"),
  new Array("LI", "11111",       "@2B2B2B2B2B2",         "73"),
  new Array("LI", "11111",       "B2B2B2B2B2B@",         "73"),
  new Array("LT", "11111",       "22222222222",          "15"),
  new Array("LT", "1111",        "22222222222",          "15"),
  new Array("LT", "X1111",       "22222222222",          "15"),
  new Array("LT", "1111@",       "22222222222",          "15"),
  new Array("LT", "11111",       "X2222222222",          "15"),
  new Array("LT", "11111",       "2222222222@",          "15"),
  new Array("LU", "111",         "B2B2B2B2B2B2B",        "27"),
  new Array("LU", "11",          "B2B2B2B2B2B2B",        "27"),
  new Array("LU", "X11",         "B2B2B2B2B2B2B",        "27"),
  new Array("LU", "11@",         "B2B2B2B2B2B2B",        "27"),
  new Array("LU", "111",         "@2B2B2B2B2B2B",        "27"),
  new Array("LU", "111",         "B2B2B2B2B2B2@",        "27"),
  new Array("LV", "AAAA",        "B2B2B2B2B2B2B",        "86"),
  new Array("LV", "AAA",         "B2B2B2B2B2B2B",        "86"),
  new Array("LV", "8AAA",        "B2B2B2B2B2B2B",        "86"),
  new Array("LV", "AAA@",        "B2B2B2B2B2B2B",        "86"),
  new Array("LV", "AAAA",        "@2B2B2B2B2B2B",        "86"),
  new Array("LV", "AAAA",        "B2B2B2B2B2B2@",        "86"),
  new Array("MC", "1111122222",  "C3C3C3C3C3C44",        "26"),
  new Array("MC", "111112222",   "C3C3C3C3C3C44",        "26"),
  new Array("MC", "X111122222",  "C3C3C3C3C3C44",        "26"),
  new Array("MC", "1111@22222",  "C3C3C3C3C3C44",        "26"),
  new Array("MC", "11111X2222",  "C3C3C3C3C3C44",        "26"),
  new Array("MC", "111112222@",  "C3C3C3C3C3C44",        "26"),
  new Array("MC", "1111122222",  "@3C3C3C3C3C44",        "26"),
  new Array("MC", "1111122222",  "C3C3C3C3C3@44",        "26"),
  new Array("MC", "1111122222",  "C3C3C3C3C3CX4",        "26"),
  new Array("MC", "1111122222",  "C3C3C3C3C3C4@",        "26"),
  new Array("ME", "111",         "222222222222233",      "38"),
  new Array("ME", "11",          "222222222222233",      "38"),
  new Array("ME", "X11",         "222222222222233",      "38"),
  new Array("ME", "11@",         "222222222222233",      "38"),
  new Array("ME", "111",         "X22222222222233",      "38"),
  new Array("ME", "111",         "222222222222@33",      "38"),
  new Array("ME", "111",         "2222222222222X3",      "38"),
  new Array("ME", "111",         "22222222222223@",      "38"),
  new Array("MK", "111",         "B2B2B2B2B233",         "41"),
  new Array("MK", "11",          "B2B2B2B2B233",         "41"),
  new Array("MK", "X11",         "B2B2B2B2B233",         "41"),
  new Array("MK", "11@",         "B2B2B2B2B233",         "41"),
  new Array("MK", "111",         "@2B2B2B2B233",         "41"),
  new Array("MK", "111",         "B2B2B2B2B@33",         "41"),
  new Array("MK", "111",         "B2B2B2B2B2X3",         "41"),
  new Array("MK", "111",         "B2B2B2B2B23@",         "41"),
  new Array("MR", "1111122222",  "3333333333344",        "21"),
  new Array("MR", "111112222",   "3333333333344",        "21"),
  new Array("MR", "X111122222",  "3333333333344",        "21"),
  new Array("MR", "1111@22222",  "3333333333344",        "21"),
  new Array("MR", "11111X2222",  "3333333333344",        "21"),
  new Array("MR", "111112222@",  "3333333333344",        "21"),
  new Array("MR", "1111122222",  "X333333333344",        "21"),
  new Array("MR", "1111122222",  "3333333333@44",        "21"),
  new Array("MR", "1111122222",  "33333333333X4",        "21"),
  new Array("MR", "1111122222",  "333333333334@",        "21"),
  new Array("MT", "AAAA22222",   "C3C3C3C3C3C3C3C3C3",   "39"),
  new Array("MT", "AAAA2222",    "C3C3C3C3C3C3C3C3C3",   "39"),
  new Array("MT", "8AAA22222",   "C3C3C3C3C3C3C3C3C3",   "39"),
  new Array("MT", "AAA@22222",   "C3C3C3C3C3C3C3C3C3",   "39"),
  new Array("MT", "AAAAX2222",   "C3C3C3C3C3C3C3C3C3",   "39"),
  new Array("MT", "AAAA2222@",   "C3C3C3C3C3C3C3C3C3",   "39"),
  new Array("MT", "AAAA22222",   "@3C3C3C3C3C3C3C3C3",   "39"),
  new Array("MT", "AAAA22222",   "C3C3C3C3C3C3C3C3C@",   "39"),
  new Array("MU", "AAAA2222",    "333333333333333DDD",   "37"),
  new Array("MU", "AAAA222",     "333333333333333DDD",   "37"),
  new Array("MU", "8AAA2222",    "333333333333333DDD",   "37"),
  new Array("MU", "AAA@2222",    "333333333333333DDD",   "37"),
  new Array("MU", "AAAAX222",    "333333333333333DDD",   "37"),
  new Array("MU", "AAAA222@",    "333333333333333DDD",   "37"),
  new Array("MU", "AAAA2222",    "X33333333333333DDD",   "37"),
  new Array("MU", "AAAA2222",    "33333333333333@DDD",   "37"),
  new Array("MU", "AAAA2222",    "3333333333333338DD",   "37"),
  new Array("MU", "AAAA2222",    "333333333333333DD@",   "37"),
  new Array("NL", "AAAA",        "2222222222",           "57"),
  new Array("NL", "AAA",         "2222222222",           "57"),
  new Array("NL", "8AAA",        "2222222222",           "57"),
  new Array("NL", "AAA@",        "2222222222",           "57"),
  new Array("NL", "AAAA",        "X222222222",           "57"),
  new Array("NL", "AAAA",        "222222222@",           "57"),
  new Array("NO", "1111",        "2222223",              "40"),
  new Array("NO", "111",         "2222223",              "40"),
  new Array("NO", "X111",        "2222223",              "40"),
  new Array("NO", "111@",        "2222223",              "40"),
  new Array("NO", "1111",        "X222223",              "40"),
  new Array("NO", "1111",        "22222@3",              "40"),
  new Array("NO", "1111",        "222222X",              "40"),
  new Array("PL", "11111111",    "2222222222222222",     "84"),
  new Array("PL", "1111111",     "2222222222222222",     "84"),
  new Array("PL", "X1111111",    "2222222222222222",     "84"),
  new Array("PL", "1111111@",    "2222222222222222",     "84"),
  new Array("PL", "11111111",    "X222222222222222",     "84"),
  new Array("PL", "11111111",    "222222222222222@",     "84"),
  new Array("PT", "11112222",    "3333333333344",        "59"),
  new Array("PT", "1111222",     "3333333333344",        "59"),
  new Array("PT", "X1112222",    "3333333333344",        "59"),
  new Array("PT", "111@2222",    "3333333333344",        "59"),
  new Array("PT", "1111X222",    "3333333333344",        "59"),
  new Array("PT", "1111222@",    "3333333333344",        "59"),
  new Array("PT", "11112222",    "X333333333344",        "59"),
  new Array("PT", "11112222",    "3333333333@44",        "59"),
  new Array("PT", "11112222",    "33333333333X4",        "59"),
  new Array("PT", "11112222",    "333333333334@",        "59"),
  new Array("RO", "AAAA",        "B2B2B2B2B2B2B2B2",     "91"),
  new Array("RO", "AAA",         "B2B2B2B2B2B2B2B2",     "91"),
  new Array("RO", "8AAA",        "B2B2B2B2B2B2B2B2",     "91"),
  new Array("RO", "AAA@",        "B2B2B2B2B2B2B2B2",     "91"),
  new Array("RO", "AAAA",        "@2B2B2B2B2B2B2B2",     "91"),
  new Array("RO", "AAAA",        "B2B2B2B2B2B2B2B@",     "91"),
  new Array("RS", "111",         "222222222222233",      "48"),
  new Array("RS", "11",          "222222222222233",      "48"),
  new Array("RS", "X11",         "222222222222233",      "48"),
  new Array("RS", "11@",         "222222222222233",      "48"),
  new Array("RS", "111",         "X22222222222233",      "48"),
  new Array("RS", "111",         "222222222222@33",      "48"),
  new Array("RS", "111",         "2222222222222X3",      "48"),
  new Array("RS", "111",         "22222222222223@",      "48"),
  new Array("SA", "11",          "B2B2B2B2B2B2B2B2B2",   "46"),
  new Array("SA", "1",           "B2B2B2B2B2B2B2B2B2",   "46"),
  new Array("SA", "X1",          "B2B2B2B2B2B2B2B2B2",   "46"),
  new Array("SA", "1@",          "B2B2B2B2B2B2B2B2B2",   "46"),
  new Array("SA", "11",          "@2B2B2B2B2B2B2B2B2",   "46"),
  new Array("SA", "11",          "B2B2B2B2B2B2B2B2B@",   "46"),
  new Array("SE", "111",         "22222222222222223",    "32"),
  new Array("SE", "11",          "22222222222222223",    "32"),
  new Array("SE", "X11",         "22222222222222223",    "32"),
  new Array("SE", "11@",         "22222222222222223",    "32"),
  new Array("SE", "111",         "X2222222222222223",    "32"),
  new Array("SE", "111",         "222222222222222@3",    "32"),
  new Array("SE", "111",         "2222222222222222X",    "32"),
  new Array("SI", "11111",       "2222222233",           "92"),
  new Array("SI", "1111",        "2222222233",           "92"),
  new Array("SI", "X1111",       "2222222233",           "92"),
  new Array("SI", "1111@",       "2222222233",           "92"),
  new Array("SI", "11111",       "X222222233",           "92"),
  new Array("SI", "11111",       "2222222@33",           "92"),
  new Array("SI", "11111",       "22222222X3",           "92"),
  new Array("SI", "11111",       "222222223@",           "92"),
  new Array("SK", "1111",        "2222222222222222",     "66"),
  new Array("SK", "111",         "2222222222222222",     "66"),
  new Array("SK", "X111",        "2222222222222222",     "66"),
  new Array("SK", "111@",        "2222222222222222",     "66"),
  new Array("SK", "1111",        "X222222222222222",     "66"),
  new Array("SK", "1111",        "222222222222222@",     "66"),
  new Array("SM", "A2222233333", "D4D4D4D4D4D4",         "71"),
  new Array("SM", "A222223333",  "D4D4D4D4D4D4",         "71"),
  new Array("SM", "82222233333", "D4D4D4D4D4D4",         "71"),
  new Array("SM", "AX222233333", "D4D4D4D4D4D4",         "71"),
  new Array("SM", "A2222@33333", "D4D4D4D4D4D4",         "71"),
  new Array("SM", "A22222X3333", "D4D4D4D4D4D4",         "71"),
  new Array("SM", "A222223333@", "D4D4D4D4D4D4",         "71"),
  new Array("SM", "A2222233333", "@4D4D4D4D4D4",         "71"),
  new Array("SM", "A2222233333", "D4D4D4D4D4D@",         "71"),
  new Array("TN", "11222",       "333333333333344",      "23"),
  new Array("TN", "1122",        "333333333333344",      "23"),
  new Array("TN", "X1222",       "333333333333344",      "23"),
  new Array("TN", "1@222",       "333333333333344",      "23"),
  new Array("TN", "11X22",       "333333333333344",      "23"),
  new Array("TN", "1122@",       "333333333333344",      "23"),
  new Array("TN", "11222",       "X33333333333344",      "23"),
  new Array("TN", "11222",       "333333333333@44",      "23"),
  new Array("TN", "11222",       "3333333333333X4",      "23"),
  new Array("TN", "11222",       "33333333333334@",      "23"),
  new Array("TR", "11111",       "BC3C3C3C3C3C3C3C3",    "95"),
  new Array("TR", "1111",        "BC3C3C3C3C3C3C3C3",    "95"),
  new Array("TR", "X1111",       "BC3C3C3C3C3C3C3C3",    "95"),
  new Array("TR", "1111@",       "BC3C3C3C3C3C3C3C3",    "95"),
  new Array("TR", "11111",       "@C3C3C3C3C3C3C3C3",    "95"),
  new Array("TR", "11111",       "B@3C3C3C3C3C3C3C3",    "95"),
  new Array("TR", "11111",       "BC3C3C3C3C3C3C3C@",    "95"),
  new Array("DE", "12345678",    "5",                    "06"),
  new Array("DE", "12345678",    "16",                   "97"),
  new Array("DE", "12345678",    "16",                   "00"),
  new Array("DE", "12345678",    "95",                   "98"),
  new Array("DE", "12345678",    "95",                   "01"));


// Translation table and translation function for localized versions
var trans_tab = new Array();

function _(s)
{
  var t = trans_tab[s];
  if (t)
    s = t;
  return s;
}

// Fill the translation table
function fill_trans_tab(trans_data)
{
  for (var i = 0; i < trans_data.length / 2; ++i)
    trans_tab[trans_data[2 * i]] = trans_data[2 * i + 1];

  // Translate the country names in the iban_data list
  for (var i = 0; i < iban_data.length; ++i)
    iban_data[i].name = _(iban_data[i].name);
}


// Set debug_output = true if location ends with a hash or a quotation mark
var debug_output = (location.href.charAt(location.href.length - 1) == "#") ||
                   (location.href.charAt(location.href.length - 1) == "?");

if (debug_output)
  debug_iban_data();

function debug_iban_data()
{
  var s = "";
  for (var i = 0; i < iban_data.length; ++i)
  {
    var country = iban_data[i];
    s += country.name + " / " + country.code + " / ";
    for (var f = 0; f < country.bank.length; ++f)
      s += country.bank[f][0] + country.bank[f][1];
    s += " = " + country.bank_lng + " / ";
    for (var f = 0; f < country.acc.length; ++f)
      s += country.acc[f][0] + country.acc[f][1];
    s += " = " + country.acc_lng + " / " + country.total_lng + "\n";
  }
  alert(s);
}

function debug_check_vars()
{
  var o = false;
  var s = "";
  for (var v in window)
  {
    if (o)
      s += "" + v + "=" + window[v] + "\n";
    if (v == "debug_check_vars")
      o = true;
  }
  if (s != "")
    alert("vars:\n" + s);
  else
    alert("no vars");
}

