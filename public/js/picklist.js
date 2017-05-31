$(function(){
var codecsPicklist = $("#codecs-picklist");

codecsPicklist.find(".pAdd").on('click', function(ev) {
  ev.preventDefault();
  var p = codecsPicklist.find(".pickData option:selected");
  p.clone().appendTo(codecsPicklist.find(".pickListResult"));
  p.remove();
});

codecsPicklist.find(".pRemove").on('click', function(ev) {
  ev.preventDefault();
  var p = codecsPicklist.find(".pickListResult option:selected");
  p.clone().appendTo(codecsPicklist.find(".pickData"));
  p.remove();
});

codecsPicklist.find(".pRemoveAll").on('click', function(ev) {
  ev.preventDefault();
  var p = codecsPicklist.find(".pickListResult option");
  p.clone().appendTo(codecsPicklist.find(".pickData"));
  p.remove();
});

var rotasPicklist = $("#rotas-picklist");

rotasPicklist.find(".pAdd").on('click', function(ev) {
  ev.preventDefault();
  var p = rotasPicklist.find(".pickData option:selected");
  p.clone().appendTo(rotasPicklist.find(".pickListResult"));
  p.remove();
});

rotasPicklist.find(".pRemove").on('click', function(ev) {
  ev.preventDefault();
  var p = rotasPicklist.find(".pickListResult option:selected");
  p.clone().appendTo(rotasPicklist.find(".pickData"));
  p.remove();
});

rotasPicklist.find(".pRemoveAll").on('click', function(ev) {
  ev.preventDefault();
  var p = rotasPicklist.find(".pickListResult option");
  p.clone().appendTo(rotasPicklist.find(".pickData"));
  p.remove();
});
});

