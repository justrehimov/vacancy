var label = document.getElementById("wrapper");
var uploadbtn = document.getElementById("upload");

function checkfile() {
    var name = document.getElementById('upload'); 
     
    if(name.files.length == 0){
        
        label.setAttribute("data-text","Select logo");
    }
    else{
        if(name.files[0].size >= 1000000){
            alert("File can not be large than 1mb");
            name.remove();
            var imageclear = document.createElement("input");
            imageclear.id ="upload";
            imageclear.setAttribute("onchange","checkfile()")
            imageclear.type = 'file';
            imageclear.class ='field';
            imageclear.accept = 'image/*';
            label.append(imageclear);
            label.setAttribute("data-text","Select logo");
        }
        else{
            label.setAttribute("data-text","Logo selected");           
        }
    }
  }

function clearerror(){
    let error =  document.getElementById("error");
    error.textContent = "";
}

//get editor data
function setEditorsData(editor1,editor2,id1,id2){
    var information = document.getElementById(id1);
    var requirements = document.getElementById(id2);
    information.value = editor1.getData();
    requirements.value = editor2.getData();
}
