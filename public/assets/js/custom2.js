function convertBoxPiece(givenpieces,piecesPerBox,meterPerBox,callback){
  var boxes             =  parseInt(givenpieces / piecesPerBox);
  var pieces            =  parseInt(givenpieces - (boxes * piecesPerBox));
  var meter             =  parseInt((meterPerBox / piecesPerBox) * givenpieces);
  callback(boxes,pieces,meter);

}
function getCurrentDate(){
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  today = mm + '/' + dd + '/' + yyyy;
  return today;
}