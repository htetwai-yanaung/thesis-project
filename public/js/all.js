// navbar scroll 
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0px";
  } else {
    document.getElementById("navbar").style.top = "-80px";
  }
  prevScrollpos = currentScrollPos;
}

// switch theme 
document.getElementById('sun').addEventListener('click',()=>{
  document.body.classList.toggle('light-mood');
  document.body.classList.toggle('dark-mood');
  document.getElementById('moon').classList.remove('d-none');
  document.getElementById('sun').classList.add('d-none');
  document.getElementById('navbar').classList.toggle('navbar-light');
  document.getElementById('navbar').classList.toggle('navbar-dark');
  document.getElementById('navbar').classList.toggle('bg-light');
  document.getElementById('navbar').classList.toggle('bg-dark');

})
document.getElementById('moon').addEventListener('click',()=>{
  document.body.classList.toggle('dark-mood');
  document.body.classList.toggle('light-mood');
  document.getElementById('sun').classList.remove('d-none');
  document.getElementById('moon').classList.add('d-none');
  document.getElementById('navbar').classList.toggle('navbar-light');
  document.getElementById('navbar').classList.toggle('navbar-dark');
  document.getElementById('navbar').classList.toggle('bg-light');
  document.getElementById('navbar').classList.toggle('bg-dark');

})
