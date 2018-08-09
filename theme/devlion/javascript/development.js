'use strict';

let textLoginError;

if (Y.one('html[lang="he"]')) {
  textLoginError = 'שם המשתמש או הסיסמא שהזנתם אינם נכונים';
} else {
  textLoginError = 'The username or password you entered is not correct';

}

Y.on('domready', function() {


  // remove link on course page
  if (Y.all(`li.breadcrumb-item a`)._nodes[1]){
    Y.all(`li.breadcrumb-item a`)._nodes[1].href = 'javacsript:void(0)';
  }

// reload screen when move over breakPoint
  const initilScreen = Y.one('body').get('offsetWidth');
  const breakPointMobile = 768;
  const breakPintDesktop = 1150;

  if (initilScreen >= breakPintDesktop) {
    Y.all('.header__sub-menu a').on('focus', function(e){
      e.target.ancestor().ancestor().addClass('active');
    });
    Y.all('.header__sub-menu a').on('blur', function(e){
        e.target.ancestor().ancestor().removeClass('active');
    });
  }
  window.onresize = function () {
    let currentScreenWidth = Y.one('body').get('offsetWidth');
    if ( (initilScreen < breakPintDesktop && breakPintDesktop < currentScreenWidth ) || (currentScreenWidth < breakPintDesktop && breakPintDesktop < initilScreen)) {
      window.location.reload(false);

    }else if ((initilScreen < breakPointMobile && breakPointMobile < currentScreenWidth ) || (currentScreenWidth < breakPointMobile && breakPointMobile < initilScreen)) {
      window.location.reload(false);
    }
  }

  // text direction on the textarea in settings menu
  Y.all('.dev-settings .text-ltr').removeClass('text-ltr');

  // last item of slider. fix masure of slider items in firefox
  Y.all('.unit__slider--options').each(function(){
        var width = this.get('clientWidth') + 1;
        this.setStyle('width', width);
  });

// header menu

if (!Y.one('.header__menu-item:nth-child(3) ul li') && Y.one('.header__menu-item:nth-child(3)')){
    Y.one('.header__menu-item:nth-child(3)').remove();
}

// course page customizatopn

  if (Y.one('.dev-course')) {
    Y.all('.dev-course .divider').setHTML('/');
  }

// user menu design customisation
  Y.all('.header__user .menu .filler').each(function() {
    this.ancestor().addClass('visualy-hidden');
  });

  // login block design customisation
  if (Y.one('.login')) {
    switch (Y.one('.login').get('childElementCount')) {
      case 1:
        Y.one('.login').get('firstChild').remove();
        Y.one('.login').get('lastChild').remove();
        break;
      case 0:
        Y.one('.login').remove();
        break;
    }
  }


  if (Y.one('.dev-login')){
    if (Y.one('label[for="username"]')) {
      var placeholderUsername = Y.one('label[for="username"]').get('text').trim();
      Y.one('#username').set('placeholder', placeholderUsername);
      var placeholderPassword = Y.one('label[for="password"]').get('text').trim();
      Y.one('#password').set('placeholder', placeholderPassword);
      Y.all('div .form-label').remove();
      Y.one('.rememberpass').remove();
      Y.one('.forgetpass').remove();
    }

    Y.one('.header__admin').hide();
    Y.one('.hamburger').hide();

    if (Y.one('#notice')){
      Y.one('.dev-login__icon').setStyle('display', 'none');
      Y.one('.dev-login__form-text--big').setStyle('display', 'none');
      if (!Y.one('html[lang="en"]')) {
        Y.one('#modal-header h4').setStyle('display', 'block').setHTML('שים לב');
      } else {
        Y.one('#modal-header h4').setStyle('display', 'block');
      }
    }

    if (Y.one('.alert-danger')) {
      var logError = Y.one('.alert-danger').addClass('dev-login__error').setHTML(textLoginError);
      Y.one('input[type="password"]').insert(logError, 'after');
    }
  }

  // frontpage design customisation
  if(Y.one('.mainbag')) {
    Y.one('.lSNext').insert(Y.one('.main-slider__btn'), 'after');
    Y.one('.main-slider__btn').setStyle('display', 'block');
  }
  // header customisation

  if (Y.one('.dir-rtl .popover-region-messages .popover-region-header-text')) {
    Y.one('.dir-rtl .popover-region-messages .popover-region-header-text').setHTML('הודעות').setStyle('display', 'block');
  }
  if (Y.one('.dir-rtl .popover-region-notifications .popover-region-header-text')) {
    Y.one('.dir-rtl .popover-region-notifications .popover-region-header-text').setHTML('התראות').setStyle('display', 'block');
  }

  // navigation menu engine
    function slideOut (block) {
      const targetBlock = Y.one(block);
      const blockHeight = targetBlock.get('scrollHeight') + 'px';
      targetBlock.transition({
        easing: 'ease-in-out',
        duration: .3, // seconds
        height: blockHeight
      }, function () {
        targetBlock.setStyle('height', 'auto');
      });
    }
    function slideIn (block) {
      const targetBlock = Y.one(block);
      const blockHeight = targetBlock.get('scrollHeight');
      targetBlock.setStyle('height', blockHeight);
      targetBlock.transition({
        easing: 'ease-in-out',
        duration: .3, // seconds
        height: '0px'
      }, function () {

      });
    }
    function initStateMenu () {
      Y.all('.header__menu-item').removeClass('header__menu-item--active');
      Y.all('.header__sub-menu').removeClass('header__sub-menu--show');
    }

  Y.one('.hamburger').on('click', function() {
    this.toggleClass('is-active');
    Y.one('.header__menu-wrap').toggleClass('header__menu-wrap--show');

    Y.all('.header__menu-item span').on('click', function(e) {
      if (e.currentTarget.ancestor().ancestor().get('childElementCount') > 1) {
        e.preventDefault();
        if (Y.one('.header__sub-menu--show')) {
          slideIn('.header__sub-menu--show');
        }
        if (e.currentTarget.ancestor().ancestor().hasClass('header__menu-item--active')){
          initStateMenu();
        }else {
          initStateMenu();
          e.currentTarget.ancestor().ancestor().addClass('header__menu-item--active');
          e.currentTarget.ancestor().ancestor().one('.header__sub-menu').addClass('header__sub-menu--show');
          slideOut('.header__sub-menu--show');
        }
      }
    });

    if (Y.one('.header__menu-wrap--show')) {
      slideOut('.header__menu-wrap');
    }else {
      slideIn('.header__menu-wrap');
    }

  });

// admin button
function moveBlockRight (block, move) {
  Y.one(block).transition({
    easing: 'ease-in-out',
    duration: .3, // seconds
    right: move,
  });
};

function moveBlockLeft (block, move) {
  Y.one(block).transition({
    easing: 'ease-in-out',
    duration: .3, // seconds
    left: move,
  });
};
function changeWidth (block, newWidth) {
  var elem = document.querySelector(block);
  elem.style.transitionDuration = '700ms';
  elem.style.width = newWidth + 'px';
};



Y.one('.header__admin').on('click', function(){
  // var mainBlock = '.devlion';
  var mainBlock = '.mainbag';
  if (Y.one('.dev-settings')) {
    mainBlock = '.dev-settings';
  }
  var clientWidth = Y.one('body').get('clientWidth');

  const initState = (move = '-260px') => {
    if (Y.one('body.dir-rtl')) {

      moveBlockLeft('.dev-aside', move);
      changeWidth(mainBlock, clientWidth);
    }else {

      moveBlockRight('.dev-aside', move);
      changeWidth(mainBlock, clientWidth);
    }
  };

  Y.one('.header__admin').toggleClass('header__admin--active');
  var moveMobile = '-58%';
  if (clientWidth < 768) {
    var moveMobile = '-88%';
  }
  var moveleft = '-260px';
  var moveToleft = '-250px';

  if (clientWidth < 1150) {
    if (Y.one('.header__admin--active')) {
      if (Y.one('body.dir-rtl')) {
        moveBlockLeft('.dev-aside', '0%');
      }else {
        moveBlockRight('.dev-aside', '0%');
      }
    }else {
      initState(moveMobile);
    }

  }else {

    if (Y.one('.header__admin--active')) {
      if (Y.one('body.dir-ltr')) {
        moveBlockRight('.dev-aside', '0px');
        changeWidth(mainBlock, clientWidth - 250);
      }else {
        moveBlockLeft('.dev-aside', '0px');
        changeWidth(mainBlock, clientWidth - 250);
      }
    } else {
      initState();
    }
  }

});


// the rotation of pictures depending on their proportions
 Y.all('.unit__slider-image').each(function(){
  var wrapRatio = this.get('clientWidth') / this.get('clientHeight');
  var pictRatio = this.one('img').get('naturalWidth') / this.one('img').get('naturalHeight');

  if (wrapRatio > pictRatio) {
    this.one('img').setStyle('width', 'auto');
    this.one('img').setStyle('height', '100%');
  }
 });

 // stop scrolling when open main menu items in desctop resolution
 if (Y.one('.mainbag')) {
   Y.all('.header__sub-menu').on('mouseenter', function(e) {

     var block = document.querySelector('.mainbag');
     var blockPosition = block.style.transform;
     var duration = block.style.transitionDuration;
     var tempStyle = Y.Node.create(`<style>.mainbag { transform:${blockPosition} !important;}</style>`);
     Y.one('body').append(tempStyle);

     Y.all('.header__sub-menu').on('mouseleave', function(e) {
       block.style.transform = blockPosition;
       tempStyle.remove();
     });

   });
  }

});
