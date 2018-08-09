`use strict`

$(document).ready(function() {

  $('#NagishLiBar').click(function(){
    $(this).toggleClass('NagishLiBarOpen');
  });

  document.querySelector('#NagishLiBar').style.cssText = '';

  $("#NagishLiLogo").hide();
  $("#NagishLiLogo").attr("src",'/theme/devlion/img/inv.png');
  $("#NagishLiLogo").show();

  $('#NagishLiInfo').parent().hide();
  $('#NLR2M').parent().hide();
  $("#NagishLiMoveBR").hide();
  $("#NagishLiMoveTR").hide();
  $("#NagishLiMoveBL").hide();
  $("#NagishLiMoveTL").hide();


  const styleMain = `



    * nagishli#NagishLiTag * {
      font-size: 1rem !important; font-family:"Alef" !important; font-weight: normal !important;
    }
    nagishli#NagishLiTag > #NagishLiBar .dropdown {
      border-bottom: 2px solid #fff;
    }

    .dir-rtl nagishli#NagishLiTag > #NagishLiBar {
      right: 0px !important;
      left: auto !important;
      top: 107px !important;
      overflow: auto ;
    }
    nagishli#NagishLiTag > #NagishLiBar.NagishLiBarOpen {
      bottom: 0 !important;
    }
    .dir-ltr nagishli#NagishLiTag > #NagishLiBar {
      right: auto !important;
      left: 0 !important;
      top: 107px !important;
      line-height: 0px !important;
      overflow: auto;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown > .dropdown-toggle {
      padding: 0px 47px!important; line-height: 2.5rem !important; text-shadow: none !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip.open {
      font-size:16px !important; background:#03a8e1 !important; border-bottom: 2px solid #fff !important; box-shadow: none !important;
    }

    .dir-ltr nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip.open {
      line-height: 1.8rem !important;
    }

    .dir-rtl nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip.open #NagishLiLogo {
      margin-left: 5px !important;
    }

    .dir-ltr nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip.open #NagishLiLogo {
      margin-right: 5px !important;
    }

    .dir-rtl nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip  #NagishLiLogo {
      padding-left: 5px !important; vertical-align: middle !important; width: 28px; margin-left: -20px;
    }

    .dir-ltr nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip  #NagishLiLogo {
      padding-right: 5px !important; vertical-align: middle !important; width: 28px; margin-right: -20px;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown > .dropdown-menu > li > div {
      color: #000 !important; box-shadow: none !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus {
      max-height: 100%;  min-width: 200px !important; overflow-x: visible !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip {
      padding: 5px !important;   font-size:0px !important; background:#03a8e1 !important; box-shadow: 0 1px 0 #00667e inset, 0 -1px 0 #00667e inset !important; box-shadow: none !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown > .dropdown-toggle, nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus.blue > .dropdown > .dropdown-toggle {
      background:#027ea9 !important; box-shadow: 0 1px 0 #5478E4 inset, 0 -1px 0 white inset !important; box-shadow: none !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown > .dropdown-toggle:hover, nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus.blue > .dropdown > .dropdown-toggle:hover {
      background:#03a8e1 !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus.blue > .dropdown:last-child > .dropdown-menu > li:last-child > div {
      border:none !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown > .dropdown-menu > li > div,
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown:last-child > .dropdown-menu > li:last-child > div,
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus.blue > .dropdown > .dropdown-menu > li > div,
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus.blue > .dropdown:last-child > .dropdown-menu > li:last-child > div {
      border: none !important; padding: 0px 45px !important; line-height: 37px !important; border-bottom: 2px solid white !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip.open {
      font-size: 1.5rem !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown > .dropdown-menu {
      z-index: 99999 !important;
    }
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown > .dropdown-toggle > .dropdown-arrow,
    nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown > .dropdown-toggle::after {
      display: none !important;
    }
    #NagishLiToggleMenus > img { display: none !important;}

    .dropdown-toggle {
      position: relative !important;
    }

    .dropdown-toggle.open:hover::before {
      border-top-color: #03a8e1;
    }

    .dropdown-toggle.open::before {
      content: '';
      position: absolute;
      top: 32px;
      left: 18px;
      display: block;
      z-index: 9999998 !important;
      border: 13px solid transparent;
      border-top-color: #027ea9;
    }

    .dir-ltr .dropdown-toggle.open::before {
      right: 18px;
      left: auto;
    }
    html[lang='ar'] .dir-rtl #NagishLiMove {
      width: 0px !important;
    }
    html[lang='ar'] .dir-rtl nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip  #NagishLiLogo {
      margin-left: 0px !important;
      margin-right: -20px !important;
    }
    html[lang='ar'] .dir-rtl nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip.open  #NagishLiLogo {
      margin-right: 0px !important;
    }
    html[lang='ar'] .dir-rtl nagishli#NagishLiTag > #NagishLiBar {
      top: 100px !important;
    }

  `;
  const styleTablet = `

  .dir-rtl nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip  #NagishLiLogo,
  .dir-ltr nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip  #NagishLiLogo {
    width: 40px !important;
  }


  .dir-rtl nagishli#NagishLiTag > #NagishLiBar,
  .dir-ltr nagishli#NagishLiTag > #NagishLiBar {
    top: 192px !important;
  }

  * nagishli#NagishLiTag * {
    font-size: 18px !important;
  }
  nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip.open {
    font-size: 28px !important;
  }
  nagishli#NagishLiTag > #NagishLiBar > #NagishLiMenus > .dropdown > .dropdown-toggle {
    line-height: 40px !important;
  }
  .dropdown-toggle.open::before {
    top: 39px;
  }

  .dir-ltr nagishli#NagishLiTag > #NagishLiBar > #NagishLiBarStrip.open {
    line-height: 43px !important;
  }
  html[lang='ar'] .dir-rtl nagishli#NagishLiTag > #NagishLiBar {
    top: 176px !important;
  }
  `;

  const styleDesktop = `

    .dir-rtl nagishli#NagishLiTag > #NagishLiBar,
    .dir-ltr nagishli#NagishLiTag > #NagishLiBar {
      top: 105px !important;
    }
    html[lang='ar'] .dir-rtl nagishli#NagishLiTag > #NagishLiBar {
      top: 93px !important;
    }
  `;


  let style = styleMain;
  if ($(window).width() >= 768 ) {
    style = style + styleTablet;
  }
  if ($(window).width() >= 1150) {
    style = style + styleTablet + styleDesktop;
  }
  $(`<style>${style}</style>`).appendTo( "body" );

  // reset button for nagishut
  let buttonText = document.querySelector(`html[lang='he']`) ?  `אפוס` :`Reset` ;
  let linkButtonText = document.querySelector(`html[lang='he']`) ?  `הצהרת נגישות` :`Accessibility Statement` ;
  const turnOff = document.querySelector(`html[lang='he']`) ?  `כבוי` : `Off`;
  const animationOff = document.querySelector(`html[lang='he']`) ? `מופסקות` : `Off`;
  const normalFont = document.querySelector(`html[lang='he']`) ?  `רגיל` : `Normal`;

  const murkup = document.createElement('span');
  murkup.classList.add('sign');
  murkup.innerHTML = `✔︎&nbsp;&nbsp;`;

  const containerForButton = document.getElementById('NagishLiMenus');
  const resetButton = document.createElement('li');

  resetButton.classList.add('dropdown');
  resetButton.innerHTML = `<div class = "dropdown-toggle"><span class = "dropdown-title">${buttonText}</span></div>`;
  containerForButton.appendChild(resetButton);

// add link button to nagishut
  const linkButton = document.createElement('li');

  linkButton.classList.add('dropdown');
  linkButton.innerHTML = `<div class = "dropdown-toggle"><a href = "${M.cfg.wwwroot}/theme/devlion/doc/הצהרת_נגישות_שלבים.pdf" class = "dropdown-title" target = "blank">${linkButtonText}</a></div>`;
  containerForButton.appendChild(linkButton);

// click on reset button
  const customEvent = new Event('click');
  resetButton.addEventListener('click', function(){
    const allButtons = Array.from(document.querySelectorAll(`#NLNormalText, #NLNormalColors, #NLNormalDisplay, #NagishLiHighlight .active >div, #NLNormalZoom, #NLNormalZoom, #NLCursorBlack.active, #NLCursorWhite.active`));

    if (document.querySelector(`#NLAnimations span[title='${animationOff}']`)){
      allButtons.push(document.querySelector(`#NLAnimations`));
    }
    if (document.querySelector(`#NLFontVal`).innerHTML !== normalFont) {
      allButtons.push(document.querySelector(`#NLFont`));
    }

    const addButtonst = Array.from(document.querySelectorAll(`#NLKBNavVal`));
    addButtonst.forEach(function(item){
      if (item.innerHTML !== turnOff) {
        allButtons.push(item.parentNode);
      }
    });

    const actives = Array.from(document.querySelectorAll('#NagishLiText .active, #NagishLiColors .active, #NagishLiDisplay .active, #NagishLiHighlight .active'));
    actives.forEach(function(item){
      item.classList.remove('active');
    });

    const signs = Array.from(document.querySelectorAll('#NagishLiText .sign, #NagishLiColors .sign, #NagishLiDisplay .sign, #NagishLiHighlight .sign'));
    signs.forEach(function(item){
      if (item) {
        item.remove();
      }
    });

    allButtons.forEach(function(item){
      item.dispatchEvent(customEvent);
      if (item.parentNode.parentNode.id == `NagishLiText` || item.parentNode.parentNode.id ==  `NagishLiColors` || item.parentNode.parentNode.id ==  `NagishLiDisplay`) {
        item.insertBefore(murkup.cloneNode(true), item.lastChild);
        item.parentNode.classList.add('active');
      }
    });

    const selected = Array.from(document.querySelectorAll('#NagishLiTag .selected'));
    selected.forEach(function(item){
      item.remove();
    });

    window.localStorage.removeItem('NagishLi');

  });

});
