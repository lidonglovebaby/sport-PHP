//ajax infobox
$(document).ready(function($) {
    // function ajaxInfobox(){
    //     console.log("entro draw infobox");
    //     $.ajax({
    //         type: "POST",
    //         url: window.profile_path,
    //         data: {
    //             id:id
    //         },
    //         cache: false,
    //         success: function(data){
    //             ibContent = data;
    //         }
    //     });
    // }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if($(".block.classes .owl-carousel .slide").length > 0){
        $(".block.classes").mCustomScrollbar({
                mouseWheel:{ scrollAmount: 350 }
        });
    }

    $(document).on('click','a[class^="compare-link-"]',function(e){
        e.preventDefault();
        
        if(!$(this).hasClass('comparing')){
            $(this).addClass("comparing");
            addFilter(this);
        }
           

    });

     $(document).on('click','.comparing_inner_container span',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var objSender = $(this);

        $.ajax({
            type: "POST",
            url: window.profile_path + "removecompare",
            data: {
                id:id
            },
            cache: false,
            success: function(data){
                resetCompare(id);
                objSender.remove();
                if($('.comparing-gyms-container span').length <= 0){
                    $('.comparing-gyms-container').hide();
                }
            }
        });
    });

     $('.compare_button_clear').click(function(){
        cleanAllComparing();
     });

     $('.compare_button').click(function(){
        
        $.ajax({
            type: 'POST',
            url: window.profile_path + "compare",
            success: function (data) {
                // Create HTML element with loaded data
                $('body').append(data);
            }
        });
        
     });

    $('.quick-view, .results .item .go_profile').live('click',  function(e){
        var id = $(e.target).parents('.facility').attr('id');
        //quickView(id);
        //return false;
        var path = window.public_path + 'gyms/' + id;
        window.location.href = path;
    });

     function addFilter(sender){
        if (sender) {
            $('.comparing-gyms-container').show();
            if($('.comparing-gyms-container span').length >=3){
                quickView(999);
            }else{
                var id = $(sender).data('id');
                var name = $(sender).data('name');
                if(id && name){
                    
                    $.ajax({
                        type: "POST",
                        url: window.profile_path + "addcompare",
                        data: {
                            id:id
                        },
                        cache: false,
                        success: function(data){
                            //console.log(sender);
                            //console.log(data);
                            //sender._contentNode.innerHTML = data;
                            $('.comparing_inner_container').append("<span data-id='"+id+"'>"+name+"</span>");
                        }
                    });
                }
            }
            
        }
     }

    function removeFilter(){

    }

     function resetCompare(id){
        var selector = 'compare-link-' + id;
        $('.'+selector).removeClass('comparing');
     }

     function cleanAllComparing(){
        //console.log('cleanin');
        $.ajax({
            type: "POST",
            url: window.profile_path + "cleancompare",
            cache: false,
            success: function(data){
                //console.log(sender);
                //console.log(data);
                //sender._contentNode.innerHTML = data;
                $('.comparing-gyms-container span').each(function(){
                    console.log(this);
                    var id = $(this).data('id');
                    resetCompare(id);
                    $(this).remove();

                });
                $('.comparing-gyms-container').hide();
            }
        });
       
     }


});