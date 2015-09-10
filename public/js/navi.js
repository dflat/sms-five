$(function(){
  var menuwidth  = 150; // pixel value for sliding menu width
  var menuspeed  = 100; // milliseconds for sliding menu animation time
  var bunwidth = menuwidth + 200;
 
  var $bdy       = $('body');
  var $container = $('#pgcontainer');
  var $burger    = $('#hamburgermenu');
  var negwidth   = "-"+menuwidth+"px";
  var poswidth   = menuwidth+"px";
  var $topTierItem = $('#hamburgermenu ul li');
  var $bun = $('#hamburgerbun');

  $topTierItem.on('click', function(e){
    
    jsAnimateTier2('open');
    $topTierItem.removeClass('currently-selected');
    $(this).addClass('currently-selected');

    var $clicked_id = $(this).attr('id');
    var $selected_submenu = "#"+ $clicked_id + "-menu";
    var $all_submenus = $('#hamburgerbun .second-tier-menu');

    $all_submenus.addClass('hidden-list');
    $($selected_submenu).removeClass('hidden-list');
    

  });
 
  $('.menubtn').on('click',function(e){
    if($bdy.hasClass('openmenu')) {
      jsAnimateMenu('close');
    } else {
      jsAnimateMenu('open');
    }
  });
 
  $('.overlay').on('click', function(e){
    if($bdy.hasClass('openmenu')) {
      jsAnimateMenu('close');
    }
  });
 
  $('a[href$="#"]').on('click', function(e){
    e.preventDefault();
  });

  function jsAnimateMenu(tog) {
    if(tog == 'open') {
      $bdy.addClass('openmenu');
 
      $container.animate({marginRight: negwidth, marginLeft: poswidth}, menuspeed);
      $bun.animate({width: poswidth}, menuspeed);
      $burger.animate({width: poswidth}, menuspeed);
      $('.overlay').animate({left: poswidth}, menuspeed);
    }
 
    if(tog == 'close') {
      $bdy.removeClass('openmenu');
 
      $container.animate({marginRight: "0", marginLeft: "0"}, menuspeed);
      $burger.animate({width: "0"}, menuspeed);
      $bun.animate({width: "0"}, menuspeed);
      $('.overlay').animate({left: "0"}, menuspeed);
    }
  }

  function jsAnimateTier2(tog) {
    if(tog == 'open') {
      $bdy.addClass('openmenu');
 
      $container.animate({marginRight: negwidth, marginLeft: poswidth}, menuspeed);
      $bun.animate({width: bunwidth}, menuspeed);
      $('.overlay').animate({left: bunwidth}, menuspeed);
    }
 
    if(tog == 'close') {
      $bdy.removeClass('openmenu');
 
      $container.animate({marginRight: "0", marginLeft: "0"}, menuspeed);
      $burger.animate({width: "0"}, menuspeed);
      $('.overlay').animate({left: "0"}, menuspeed);
    }
  }
});

