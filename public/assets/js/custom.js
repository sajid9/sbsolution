function convertBoxPiece(givenpieces,piecesPerBox,meterPerBox,callback){
  var boxes             =  parseInt(givenpieces / piecesPerBox);
  var pieces            =  parseInt(givenpieces - (boxes * piecesPerBox));
  var meter             =  parseInt((meterPerBox / piecesPerBox) * givenpieces);
  callback(boxes,pieces,meter);

}