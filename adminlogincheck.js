var elm= document.getElementById('user');
if(elm)
{
elm.addEventListener('keyup',check);
}

function check(){

var currentval=elm.value;

var reg1=/admin/i;
var change=document.getElementById('sign_in_button');

if(reg1.test(currentval))
{
    var change=document.getElementById('sign_in_button');
    change.style.transition=0.2 ;
    change.value="Sign in as Admin";
}
else
{
    change.value="Sign In";
}


}