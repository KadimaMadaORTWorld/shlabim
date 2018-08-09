$(document).ready(function() {
  var tabletBreackPoint = 767;
  var desktopBreackPoint = 1149;
  var drag = false;
  var direction = true;


    var mainSlider = $("#main-slider").lightSlider({
      rtl: direction,
      item: 1,
      slideMargin: 0,
      enableDrag: drag,
      pager: false,
      auto: true,
      loop: true,
      pause: 8000,
      speed: 800,
      cssEasing: 'ease-in-out'
    });

    $('.main-slider__btn').click(function(e){
      if ($(e.currentTarget).hasClass('main-slider__btn--pause')) {
        mainSlider.pause();
        $(e.currentTarget).addClass('main-slider__btn--play');
        $(e.currentTarget).removeClass('main-slider__btn--pause');
      }else {
        mainSlider.play();
        $(e.currentTarget).addClass('main-slider__btn--pause');
        $(e.currentTarget).removeClass('main-slider__btn--play');
      }

    });

  // lessons slider
  if (Y.one('.unit__slider--lessons')) {
    var numberOfItems = Y.one('.unit__slider--lessons').get('childElementCount');
    var desktopMaxItems = Math.min(6, numberOfItems);
    var tabletMaxItems = Math.min(3, numberOfItems);

    var unitSliderLessons = $(".unit__slider--lessons").lightSlider({
      rtl: direction,
      item: desktopMaxItems,
      slideMargin: 0,
      enableDrag: drag,
      pager: false,
      auto: false,
      loop: false,
      pause: 5000,
      speed: 800,
      controls: false,
      cssEasing: 'ease-in-out',
      responsive : [
          {
              breakpoint: desktopBreackPoint,
              settings: {
                  item: tabletMaxItems
              }
          },
          {
              breakpoint: tabletBreackPoint,
              settings: {
                  item:1
              }
          }
      ]
    });

    $('#unitSliderLessonsPrev').click(function(){
      unitSliderLessons.goToNextSlide();
    });
    $('#unitSliderLessonsNext').click(function(){
      unitSliderLessons.goToPrevSlide();
    });

  }
    //slider Teaching aids (middle)
  if (Y.one('#unit__slider--materials-middle0')) {
    var numberOfItems = Y.one('#unit__slider--materials-middle0').get('childElementCount');
    var desktopMaxItems = Math.min(6, numberOfItems);
    var tabletMaxItems = Math.min(3, numberOfItems);

    var unitSliderMaterials0 = $("#unit__slider--materials-middle0").lightSlider({
      rtl: direction,
      item: desktopMaxItems,
      slideMargin: 0,
      enableDrag: drag,
      pager: false,
      auto: false,
      loop: false,
      pause: 5000,
      speed: 800,
      controls: false,
      cssEasing: 'ease-in-out',
      responsive : [
          {
              breakpoint: desktopBreackPoint,
              settings: {
                  item:tabletMaxItems
              }
          },
          {
              breakpoint: tabletBreackPoint,
              settings: {
                  item:1
              }
          }
      ]
    });

    $('#unitSliderMaterialsPrev0').click(function(){
      unitSliderMaterials0.goToNextSlide();
    });
    $('#unitSliderMaterialsNext0').click(function(){
      unitSliderMaterials0.goToPrevSlide();
    });
  }

  if (Y.one('#unit__slider--materials-middle1')) {
    var numberOfItems = Y.one('#unit__slider--materials-middle1').get('childElementCount');
    var desktopMaxItems = Math.min(6, numberOfItems);
    var tabletMaxItems = Math.min(3, numberOfItems);

    var unitSliderMaterials1 = $("#unit__slider--materials-middle1").lightSlider({
      rtl: direction,
      item: desktopMaxItems,
      slideMargin: 0,
      enableDrag: drag,
      pager: false,
      auto: false,
      loop: false,
      pause: 5000,
      speed: 800,
      controls: false,
      cssEasing: 'ease-in-out',
      responsive : [
          {
              breakpoint: desktopBreackPoint,
              settings: {
                  item:tabletMaxItems
              }
          },
          {
              breakpoint: tabletBreackPoint,
              settings: {
                  item:1
              }
          }
      ]
    });

    $('#unitSliderMaterialsPrev1').click(function(){
      unitSliderMaterials1.goToNextSlide();
    });
    $('#unitSliderMaterialsNext1').click(function(){
      unitSliderMaterials1.goToPrevSlide();
    });
  }

    //slider Teaching aids (hight)
  if (Y.one('.unit__slider--materials-hight')) {
    var desktopMaxItems = Math.min(6, Y.one('.unit__slider--materials-hight').get('childElementCount'));
    var tabletMaxItems = Math.min(2, Y.one('.unit__slider--materials-hight').get('childElementCount'));

    $(".unit__slider--materials-hight").lightSlider({
      rtl: direction,
      item: desktopMaxItems,
      slideMargin: 0,
      enableDrag: drag,
      pager: false,
      auto: false,
      loop: false,
      pause: 5000,
      speed: 800,
      cssEasing: 'ease-in-out',
      responsive : [
          {
              breakpoint: desktopBreackPoint,
              settings: {
                  item:1
              }
          }
      ]
    });
  }

    //slider addition options
  if (Y.one('.unit__slider--options')) {
    var desktopMaxItems = Math.min(6, Y.one('.unit__slider--options').get('childElementCount'));
    var tabletMaxItems = Math.min(2, Y.one('.unit__slider--options').get('childElementCount'));

    var unitSliderOptions =  $(".unit__slider--options").lightSlider({
      rtl: direction,
      // adaptiveHeight:true,
      item: 6,
      slideMargin: 0,
      enableDrag: drag,
      pager: false,
      auto: false,
      loop: false,
      pause: 5000,
      speed: 800,
      controls: false,
      cssEasing: 'ease-in-out',
      responsive : [
          {
              breakpoint: desktopBreackPoint,
              settings: {
                  item: 2
              }
          },
          {
              breakpoint: tabletBreackPoint,
              settings: {
                  item:1
              }
          }
      ]
    });

    $('#unitSliderOptionsPrev').click(function(){
      unitSliderOptions.goToNextSlide();
    });
    $('#unitSliderOptionsNext').click(function(){
      unitSliderOptions.goToPrevSlide();
    });
  }
    //slider additions
  if (Y.one('.unit__slider--additions')) {
    var desktopMaxItems = Math.min(6, Y.one('.unit__slider--additions').get('childElementCount'));

    var unitSliderAdditions = $(".unit__slider--additions").lightSlider({
      rtl: direction,
      item: 6,
      // adaptiveHeight:true,
      slideMargin: 0,
      enableDrag: drag,
      pager: false,
      auto: false,
      loop: false,
      pause: 5000,
      speed: 800,
      controls: false,
      cssEasing: 'ease-in-out',
      responsive : [
          {
              breakpoint: desktopBreackPoint,
              settings: {
                  item:2
              }
          },
              {
                  breakpoint: tabletBreackPoint,
                  settings: {
                      item:1
                  }
              }

      ]
    });
    $('#unitSliderAdditionsPrev').click(function(){
      unitSliderAdditions.goToNextSlide();
    });
    $('#unitSliderAdditionsNext').click(function(){
      unitSliderAdditions.goToPrevSlide();
    });
  }

  if (Y.one('#page-nav-slider')) {
    var desktopMaxItems = Math.min(4, Y.one('#page-nav-slider').get('childElementCount'));
    $("#page-nav-slider").lightSlider({
      rtl: direction,
      item: desktopMaxItems,
      slideMargin: 0,
      enableDrag: drag,
      pager: false,
      auto: false,
      loop: false,
      pause: 5000,
      speed: 800,
      cssEasing: 'ease-in-out',
      responsive : [
          {
              breakpoint: desktopBreackPoint,
              settings: {
                  item:2,
                  enableDrag: true,
              }
          },
          {
              breakpoint: tabletBreackPoint,
              settings: {
                  item:1,
                  enableDrag: true,
              }
          }
      ]
    });

  }

});
