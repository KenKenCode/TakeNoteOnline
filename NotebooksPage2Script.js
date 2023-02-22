const navLinks = document.querySelector(".nav-links");

const showMenu = () => {
    navLinks.classList.toggle("show"); //will show the nav links that has been hidden because of .nav_links {display: none;}
}

$(document).ready(function(){
    $('button').click(function(){
        id_student = $(this).attr('id') //id_student will retrieve current id attribute of button
        $.ajax({url: "select.php",
        method:'post',
        data:{student_id:id_student},
        success: function(result){
    $(".modal-body").html(result);
  }});


        $('#myModal').modal("show");
    })
})