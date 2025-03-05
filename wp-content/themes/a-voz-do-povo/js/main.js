//UPDATE DATA E HORA
const dataInicial = new Date();

function atualizarDataHora() {
  const agora = new Date();

  // Calcula a diferença em milissegundos desde a inicialização
  const diferenca = agora - dataInicial;

  // Ajusta a data com base na diferença
  const dataAtualizada = new Date(dataInicial.getTime() + diferenca);

  // Formata a data em português
  const opcoes = {
      timeZone: "America/Cuiaba",
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit'
  };
  const dataFormatada = dataAtualizada.toLocaleDateString('pt-BR', opcoes);

  // Exibe a data no elemento
  document.getElementById('timeNow').textContent = dataFormatada;
}

setInterval(atualizarDataHora, 1000);
atualizarDataHora();

//SOBRA NO SCROLL EDITORIAS NO MOBILE
const nav = document.querySelector('.header_nav nav');
const ul = nav.querySelector('ul');

const checkScrollPosition = () => {
  const scrollTop = ul.scrollTop;
  const scrollHeight = ul.scrollHeight;
  const clientHeight = ul.clientHeight;

  const isAtTop = scrollTop <= 1; 

  if (isAtTop) {
    nav.style.setProperty('--opacity-before', '0');
    nav.style.setProperty('--opacity-after', '1');
  } else if (scrollTop + clientHeight === scrollHeight) {
    nav.style.setProperty('--opacity-before', '1');
    nav.style.setProperty('--opacity-after', '0');
  } else {
    nav.style.setProperty('--opacity-before', '1');
    nav.style.setProperty('--opacity-after', '1');
  }
};

ul.addEventListener('scroll', checkScrollPosition);
document.addEventListener('DOMContentLoaded', checkScrollPosition);

//OPEN MENU MOBILE
const toggleMenu = document.querySelector('.header_toggle');
const headerNav = document.querySelector('.header_nav');
toggleMenu.addEventListener('click',function(e){
  toggleMenu.classList.toggle('active');
  headerNav.classList.toggle('active');
})

//AUTO SET MARGIN TO MAIN
document.addEventListener("DOMContentLoaded", function () {
  function adjustMainMargin() {
    const header = document.querySelector("header");
    const main = document.querySelector("main");
    
    if (header && main) {
      const headerHeight = header.offsetHeight;
      main.style.marginTop = `${headerHeight}px`;
    }
  }
  
  adjustMainMargin();
  window.addEventListener("resize", adjustMainMargin);
});

//HERO SWIPER
const swiper = new Swiper('.swiper', {
  loop: true,
  autoplay:{
    delay:5000,
    pauseOnMouseEnter:true,
  },

  // Navigation arrows
  spaceBetween:16,
});

//CLOSE PUBLI POPUP
const modalPopup = document.querySelector('.publi-popup');
if(modalPopup){
  const btnClosePopup = modalPopup.querySelector('.publi-popup_close-button');
  btnClosePopup.addEventListener('click',function(e){
    modalPopup.classList.add('publi-popup-close');
  })
}

//INPUT MASKS
$(document).ready(function(){
  $(".phoneMask").inputmask({
    mask: ["(99) 9999-9999", "(99) 99999-9999"],
    keepStatic: true
  });

  $('.wpcf7-form').submit(function(event) {
    // Antes do envio, limpe o valor do campo 'phone'
    var phoneValue = $("input[name='phone']").inputmask("unmaskedvalue");
    $("input[name='phone']").val(phoneValue);
});

});


// SEARCH FORM
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("search-form").addEventListener("submit", function (event) {
    let searchInput = document.getElementById("search-input").value.trim();

    if (searchInput === "") {
      alert("Digite pelo menos algum caracter para realizar a busca.");
      event.preventDefault(); // Impede o envio do formulário
    }
  });
});