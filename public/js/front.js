
function validate_form()
{
//console.log("hi");

//address field
  var add = document.forms["userform"]["address"].value;
  if (add == "")
  {
alert("address must be filled out");
     return false;
  }

  //Name

  var name = document.forms["userform"]["name"].value;
  if (name == "")
  {
alert("Name must be filled out");
     return false;
  }

  //Age

  var age = document.forms["userform"]["age"].value;
  if (age == "")
  {
alert("Age must be filled out");
     return false;
  }

 //Gender field
  var gender = document.forms["userform"]["gender"].value;
  if (gender == "")
  {
alert("Gender must be selected");
     return false;
  }

//image field
  var image = document.forms["userform"]["img"].value;
  if (image == "")
  {
alert("image is required");
     return false;
  }

}

