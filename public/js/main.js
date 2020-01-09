function loadTemplateData(){
  var template = document.getElementById('templateSelector').value
  var towrite= document.getElementById('inputDetails');
  towrite.innerHTML=template;
}
