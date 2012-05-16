$(document).ready(function(){
    var totalWidth=0;
    var positions = new Array();

    $('#slides .slide ').each(function(i){
        positions[i]= totalWidth;
        totalWidth += $(this).width();
    });

    $('#slides').width(totalWidth);


    $('#navigation ul li a').click(function(e){
        $('#navigation ul li').each(function(i){
            $(this).removeClass('selected');
        });
     
        $(this).parent().addClass('selected');
        var position = $(this).parent().prevAll('.navButton').length;

        $('#slides').stop().animate({
            marginLeft:-positions[position]+'px'
        },450);

        e.preventDefault();
        /* prevention d'un deuxieme clique */
        //@todo : blocker le tab key a la dans le dernier input
        $('#slides').find('fieldset').each(function(){
            $(this).find('p:last').children(':input').keydown(function(e){
                if (e.which == 9){
                    e.preventDefault();
                }
            });
        });
    });
});