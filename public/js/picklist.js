$(function(){
var codecs_picklist = $("#codecs-picklist");

codecs_picklist.find(".pAdd").on('click', function(ev) {
  ev.preventDefault();
  var p = codecs_picklist.find(".pickData option:selected");
  p.clone().appendTo(codecs_picklist.find(".pickListResult"));
  p.remove();
});

codecs_picklist.find(".pRemove").on('click', function(ev) {
  ev.preventDefault();
  var p = codecs_picklist.find(".pickListResult option:selected");
  p.clone().appendTo(codecs_picklist.find(".pickData"));
  p.remove();
});

codecs_picklist.find(".pRemoveAll").on('click', function(ev) {
  ev.preventDefault();
  var p = codecs_picklist.find(".pickListResult option");
  p.clone().appendTo(codecs_picklist.find(".pickData"));
  p.remove();
});

var rotas_picklist = $("#rotas-picklist");

rotas_picklist.find(".pAdd").on('click', function(ev) {
  ev.preventDefault();
  var p = rotas_picklist.find(".pickData option:selected");
  p.clone().appendTo(rotas_picklist.find(".pickListResult"));
  p.remove();
});

rotas_picklist.find(".pRemove").on('click', function(ev) {
  console.log('hay');
  ev.preventDefault();
  var p = rotas_picklist.find(".pickListResult option:selected");
  p.clone().appendTo(rotas_picklist.find(".pickData"));
  p.remove();
});

rotas_picklist.find(".pRemoveAll").on('click', function(ev) {
  ev.preventDefault();
  var p = rotas_picklist.find(".pickListResult option");
  p.clone().appendTo(rotas_picklist.find(".pickData"));
  p.remove();
});
});

