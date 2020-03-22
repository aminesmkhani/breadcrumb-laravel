let Toggle=false;
// this event and function for change active step li
$("#sidebar_menu li").click(function () {
    if(!$(this).hasClass('active')){
        $("#sidebar_menu li").removeClass('active');
        $(this).addClass('active');
        $('.child_menu').slideUp(500);
        $('#sidebar_menu .fa-angle-down').removeClass('fa-angle-down');
        $('.fa-angle-left',this).addClass('fa-angle-down');
        if(!Toggle)
        {
            $('.child_menu',this).slideDown(500);
        }
        else{
            $('.child_menu',this).show();
        }
    }
    else if(Toggle){
        $('.child_menu').slideUp(500);
        $('.child_menu',this).show();
    }
});
// thi event for change size and drop toggle
$("#sidebarToggle").click(function () {
    if($(".admin_sidebar").hasClass('toggled'))
    {
        Toggle=false;
        $('.admin_sidebar').removeClass('toggled');
        $("#sidebar_menu").find('.active .child_menu').css('display','block');
        $('.admin_content').css('margin-right','240px');
    }
    else {
        Toggle=true;
        $('.admin_sidebar').addClass('toggled');
        $(".child_menu").hide();
        $('.admin_content').css('margin-right','50px');
    }
});
// this function for resize sidebar min with change 850px
$(window).resize(function () {
   set_sidebar_width();
});
$(document).ready(function () {
    set_sidebar_width();
});

// this function for set  resize window change sidebar width
set_sidebar_width=function () {
    const width=document.body.offsetWidth;
    if (width<850)
    {
        $('.admin_sidebar').addClass('toggled');
        $('.admin_content').css('margin-right','50px');
        $(".child_menu").hide();
    }else {
        if (Toggle===false){
            $('.admin_sidebar').removeClass('toggled');
            $('.admin_content').css('margin-right','240px');
        }
    }
};

// this function for select file in click image
select_file=function () {
    $("#pic").click();
};
// this function for show images before upload server
loadFile=function (event) {
    const render=new FileReader();
    render.onload=function () {
        const output=document.getElementById('output');
        output.src=render.result;
    };
    render.readAsDataURL(event.target.files[0]);
};
//####//
let delete_url;
// receive and save token
let token;
// send data in array in server
let send_array_data=false;
// set default method field DELETE
let _method='DELETE';
/*
|--------------------------------------------------------------------------
| del_row function
|--------------------------------------------------------------------------
|
| this function for show yes or no for
| delete item
| 2 function embed in area
| function 1 : delete_row() yes button
| function 2: hide_box() no button
| lets; delete_url,token
| input: url,t,message_text
| t= token value
| message_text= system message in show admin
*/
del_row= function (url,t,message_text)
{
    //recovery method first step
    _method='DELETE';
    delete_url=url;
    token=t;
    // receive and show message
    $("#msg").text(message_text);
    $(".message_div").show();
};
// this embed function for click yes button delete items
// create post form and submit with javascript
delete_row=function () {
   if (send_array_data){
        $("#data_form").submit();
   }else
   {
       //create form
       let form=document.createElement('form');
       // set attribute form
       form.setAttribute('method','POST');
       // set action
       form.setAttribute('action',delete_url);
       // set method input for identification laravel
       const hiddenField1=document.createElement('input');
       hiddenField1.setAttribute('name','_method');
       hiddenField1.setAttribute('value',_method);
       // add input to form
       form.appendChild(hiddenField1);

       // set token input for identification laravel
       const hiddenField2=document.createElement('input');
       hiddenField2.setAttribute('name','_token');
       hiddenField2.setAttribute('value',token);
       // add token to form
       form.appendChild(hiddenField2);

       // add form to body
       document.body.appendChild(form);
       form.submit();
       // remove form in body
       document.body.removeChild(form);
   }
};
// this embed function for click no button close message window
hide_box=function () {
    token='';
    delete_url='';
    $(".message_div").hide();
};
//####

/*
|--------------------------------------------------------------------------
| function for checkbox count
|--------------------------------------------------------------------------
|
| this function for find checkbox count
| and select check box
*/

$('.check_box').click(function () {
    send_array_data=false;
    // length how check box
    const $checkboxes=$('table tr td input[type="checkbox"]');
    // how select check box
    const count=$checkboxes.filter(':checked').length;
    if (count>0)
    {
        // delete off class
        $("#remove_items").removeClass('off');
        $("#restore_items").removeClass('off')
    }else
    {
        // add off class
        $("#remove_items").addClass('off');
        $("#restore_items").addClass('off')
    }
});
// event for click delete button
$('.item_form').click(function () {
    send_array_data=true;
    // length how check box
    const $checkboxes=$('table tr td input[type="checkbox"]');
    // how select check box
    const count=$checkboxes.filter(':checked').length;
    if (count>0){
        const href=window.location.href.split('?');
        let action=href[0]+"/"+this.id;
        if (href.length===2){
            action=action+"?"+href[1];
        }
        $("#data_form").attr('action',action);
        $("#msg").text($(this).attr('msg'));
        $('.message_div').show();
    }
});

// show tooltip bootstrap
$('span').tooltip();
/*
|--------------------------------------------------------------------------
| restore_item function
|--------------------------------------------------------------------------
|
| this function for restore delete item single or multi
| input: url,t,message_text
| t= token value
| message_text= system message in show admin
*/

restore_row=function (url,t,message_text) {
    _method='post';
    delete_url=url;
    token=t;
    $("#msg").text(message_text);
    // show message
    $('.message_div').show();
};



