
(function(){
  function send(msg){
    try{ parent.postMessage(msg, '*'); }catch(e){}
  }
  function onLinkClick(a, opts){
    a.addEventListener('click', (e)=>{
      e.preventDefault();
      send({type:'navigate', ...opts});
    });
  }

  // Map by option class (keeps your structure/styles)
  const opt1 = document.querySelector('.container-main__option1 a');
  const opt2 = document.querySelector('.container-main__option2 a');
  const opt3 = document.querySelector('.container-main__option3 a');
  const opt4 = document.querySelector('.container-main__option4 a');
  const salir = document.querySelector('.container-main__btn');

  const page = (location.pathname.split('/').pop() || '').toLowerCase();

  const isMedico = page.includes('menumedico');
  const isPaciente = page.includes('menupaciente');

  if(isMedico){
    opt1 && onLinkClick(opt1, {target:'inicioMedico.html', keepMenu:true});
    opt2 && onLinkClick(opt2, {target:'consultarMiUsario.html', keepMenu:true});
    opt3 && onLinkClick(opt3, {target:'listaDeEspera.html', keepMenu:true});
    opt4 && onLinkClick(opt4, {target:'historial.html', keepMenu:true});
  }

  if(isPaciente){
    opt1 && onLinkClick(opt1, {target:'inicioPaciente.html', keepMenu:true});
    opt2 && onLinkClick(opt2, {target:'consultarMiUsario.html', keepMenu:true});
    opt3 && onLinkClick(opt3, {target:'consultarMiUsario.html', keepMenu:true, scrollTo:'historias'});
    opt4 && onLinkClick(opt4, {target:'solicitarAcceso.html', keepMenu:true});
  }

  salir && salir.addEventListener('click', ()=> send({type:'closeMenu'}));
})();
