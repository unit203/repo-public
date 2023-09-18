<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/style.css"> -->

  </head>
  <body>

    <div class="container mt-5">
      <div class="row">


        <div class="col-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <!-- <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Главная</a> -->
          <!-- Тут ок -->
          <a class="nav-link" id="profileTab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Профиль</a>
          <a class="nav-link" id="messagesTab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Сообщения</a>
          <a class="nav-link" id="settingsTab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Настройки</a>
        </div>
        </div>
        <div class="col-9">
          <div class="col-sm-4">
            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHx8MA%3D%3D&w=300&q=70" alt="Фото пользователя" width="100%">
          </div>
  
          <div class="col-cm-8">
            <h2>
              <!-- <? echo $_SESSION["name"]; ?>  -->
              <!-- <? echo $_SESSION["lastname"]; ?>   -->
            <span id="userName"></span>
            порядковый номер №ID:
            <span id="userId"></span>
          </h2>
            <p>Email:
              <span>
              <!-- <? echo $_SESSION["email"]; ?> -->
              <span id="userMail"></span>
              </span>
            </p>
            <h3>О себе рассказывает и кому то даже показывает</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, commodi!</p>
  
          </div>
            <div class="tab-content" id="v-pills-tabContent">
            <!-- <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"></div> -->
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">Страница профиля</div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Имя</th>
                  <th scope="col">Фамилия</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody id="usersListTable">
                <!-- Данные после запроса будут вставлены тут -->
              </tbody>
            </table>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">Страница настроек</div>
        </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
      let pathname = location.pathname.split("/")[2];
      let navLinks = document.querySelectorAll(".nav-link");
      let userName = document.querySelector("#userName");
      let userMail = document.querySelector("#userMail");

      // let user;
      async function getUser() {
        let response = await fetch("/getUser");
        return await response.json();
      }

      async function getUsers() {
        let response = await fetch("/getUsers");
        return await response.json();
      }


      addEventListener("popstate", (event) => {
        let pathPop = location.pathname.split("/")[2];

        if (pathPop == "profile") {
        $('#profileTab').tab('show')
        } else if (pathPop == "messages") {
          $('#messagesTab').tab('show')
        } else if (pathPop == "settings") {
          $('#settingsTab').tab('show')
        }
      })

      if (pathname == "profile") {

        // user = getUser();
        // Это промисс - функция гетЮзер.then метод даст после выполнения результат работы коллбека.
        getUser().then((user) => {
          console.log(user);
          userName.innerText = `${user.name} ${user.lastname} `;
          userMail.innerText = `${user.email}`;
          userId.innerText = `${user.id}`;
        })


        $('#v-pills-profile').tab('show')
      } else if (pathname == "messages") {
        getUsers().then((users) => {
          console.log(users);
          for (let i = 0; i < users.length; i++) {
            console.log("цикл сработал");
            usersListTable.insertAdjacentHTML("beforeend", `
              <tr>
                <th scope="row">${users[i].id}</th>
                <td scope="col">${users[i].name}</td>
                <td scope="col">${users[i].lastname}</td>
                <td scope="col">${users[i].email}</td>
              </tr>
              `);
          }
        })





        $('#v-pills-messages').tab('show')
      } else if (pathname == "settings") {
        $('#v-pills-settings').tab('show')
      } else {
        location.href = location.protocol + "//" + location.host;
      }

      for (let i = 0; i < navLinks.length; i++) {
        navLinks[i].addEventListener("click", () => {
          let page = navLinks[i].getAttribute("aria-controls").split("v-pills-")[1];
          console.log(page);
          history.pushState("", "", page);

        })
      }

      document.getElementById(pathname+ "Tab").classList.add("active");




    </script>
  </body>
</html>