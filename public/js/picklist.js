$(function(){
var pickThis = $("#codecs-picklist");

pickThis.find(".pAdd").on('click', function(ev) {
  ev.preventDefault();
  var p = pickThis.find(".pickData option:selected");
  p.clone().appendTo(pickThis.find(".pickListResult"));
  p.remove();
});

pickThis.find(".pRemove").on('click', function(ev) {
  ev.preventDefault();
  var p = pickThis.find(".pickListResult option:selected");
  p.clone().appendTo(pickThis.find(".pickData"));
  p.remove();
});

pickThis.find(".pRemoveAll").on('click', function(ev) {
  ev.preventDefault();
  var p = pickThis.find(".pickListResult option");
  p.clone().appendTo(pickThis.find(".pickData"));
  p.remove();
});

var pickThis = $("#rotas-picklist");

pickThis.find(".pAdd").on('click', function(ev) {
  ev.preventDefault();
  var p = pickThis.find(".pickData option:selected");
  p.clone().appendTo(pickThis.find(".pickListResult"));
  p.remove();
});

pickThis.find(".pRemove").on('click', function(ev) {
  ev.preventDefault();
  var p = pickThis.find(".pickListResult option:selected");
  p.clone().appendTo(pickThis.find(".pickData"));
  p.remove();
});

pickThis.find(".pRemoveAll").on('click', function(ev) {
  ev.preventDefault();
  var p = pickThis.find(".pickListResult option");
  p.clone().appendTo(pickThis.find(".pickData"));
  p.remove();
});
});

