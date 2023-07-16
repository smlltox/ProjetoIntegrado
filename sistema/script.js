//mostra porfolio de cada tatuador

function mostrarLista() {
  var lista = document.getElementById("minhaLista");
	if (lista.style.display === "none") {
		lista.style.display = "block";
	} else {
		lista.style.display = "none";
	}
}

function mostrarLista2() {
  var lista = document.getElementById("minhaLista2");
	if (lista.style.display === "none") {
		lista.style.display = "block";
	} else {
		lista.style.display = "none";
	}
}

//tela inicial

document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    var objeto = document.getElementById('inicial');
    if (objeto) {
      objeto.style.transform = "translateY(-500px)";
    }
  }, 500); // atraso de 500ms
});

//telinhas de login/cadastro/orçamentos

window.addEventListener('load', function() {
  setTimeout(function() {
    var objeto = document.querySelector('.login-screen');
    objeto.style.transform = "translateY(700px)";
  }, 500); // atraso de 500ms
});

//imagens em destque no index

var imagens = document.querySelectorAll('#galeria img');
var meio = Math.floor(imagens.length / 2); // índice da imagem do meio

for (var i = 0; i < imagens.length; i++) {
  if (i === meio) {
    imagens[i].classList.add('grande');
  } else {
    imagens[i].classList.add('pequena');
  }

  imagens[i].addEventListener('mouseover', function() {
    this.classList.add('grande');
  });

  imagens[i].addEventListener('mouseout', function() {
    this.classList.remove('grande');
  });
}

//testa se é adm

window.addEventListener("load", function() {
  // verifique se o usuário é um administrador!!!!!!!!!!!!!!!!!
  var isAdmin = true;

  // encontre o botão do administrador na página
  var adminButtons = document.getElementsByClassName("adminButton");

  // se o usuário for um administrador, exiba o botão do administrador
  if (isAdmin) {
    for (var i = 0; i < adminButtons.length; i++) {
      adminButtons[i].style.display = "block";
    }
  }
});

