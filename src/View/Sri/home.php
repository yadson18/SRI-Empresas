<div class="container-fluid" id="home-content">
  <div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1" id="div-container">
    <h1 class="text-center" id="title">
      Bem-vindo <?= $this_->getData("User")[0]["NOME"] ?>, o que deseja fazer?
    </h1>
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-sm-6 div-box">
        <a href="/Companies/add">
          <div class="col-xs-12 col-sm-12 col-md-12 div-function">
            <div>
              <h1>
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                Cadastrar Empresa
              </h1>
            </div>
          </div>
        </a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-sm-6 div-box">
        <a href="#">
          <div class="col-xs-12 col-sm-12 col-md-12 div-function">
            <div>
              <h1>
                <i class="fa fa-plus" aria-hidden="true"></i>
                Outra função
              </h1>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>