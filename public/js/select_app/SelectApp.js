class SelectApp {
    constructor(selectID) {
        this.ajaxUrl = "/api";
        this.resultBox = false;
        this.selectElement = document.getElementById(selectID);
        if (this.selectElement.hasAttribute("data-ajax-url")) {
            this.ajaxUrl = this.selectElement.getAttribute("data-ajax-url");
        }
        if (this.selectElement.hasAttribute("data-result-box")) {
            let resultBoxID = this.selectElement.getAttribute("data-result-box");
            this.resultBox = document.getElementById(resultBoxID);
        }
        this.getUsers();
        this.selectElement.addEventListener("change", (e) => {
            this.getTransaction(e)
        })
    }

    getUsers() {
        fetch(this.ajaxUrl + "/user/get-all", {
            method: 'GET',
            headers: {
                'Content-type': 'text/html; charset=UTF-8',
            },
        })
            .then((response) => response.json())
            .then((data) => {
                this.selectElement.innerHTML = "";
                let firstOption = document.createElement("option")
                firstOption.innerHTML = "Выберите пользователя ...";
                this.selectElement.appendChild(firstOption);
                data.forEach((user) => {
                    let option = document.createElement("option");
                    option.setAttribute("value", user.id);
                    option.innerHTML = user.name;
                    this.selectElement.appendChild(option);
                });
            })
    }

    renderTransaction(data) {
        console.log("user select", data)
        if (this.resultBox) {
            this.resultBox.innerHTML = templates.resultTable(data);
        }
    }

    getTransaction(event) {
        console.log(this)
        fetch(this.ajaxUrl + "/transaction/get-by-id?user_id=" + event.target.value, {
            method: 'GET',
            headers: {
                'Content-type': 'text/html; charset=UTF-8',
            },
        })
            .then((response) => response.json())
            .then((data) => {
                this.renderTransaction(data)
            })
    }
}

const templates =
    {
        resultTable: (data) => {
            return `<table class="table table-bordered margin-top-lg">
                <thead>
                <tr>
                    <th>Месяц</th>
                    <th>Поступления</th>
                    <th>Списания</th>
                    <th>Баланс</th>
                </tr>
                </thead>
                <tbody>
                ${data.map(function (item) {
                    return `<tr>
                        <td>${item.month}</td>
                        <td>${item.income}</td>
                        <td>${item.outcome}</td>
                        <td>${item.income - item.outcome}</td>
                    </tr>`;
                })}
                </tbody>
            </table>`;
        },
        resultTableRow: (rowData) => {
            return `<tr>
                <td>2024-02</td>
                <td>100</td>
                <td>500</td>
                <td>-400</td>
            </tr>`;
        },
        option: (id, name) => {
            return `<option value="${id}">${name}</option>`;
        },
        defaultBox: () => {
            return `<div class="card">
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/184.webp" class="card-img-top" alt="Fissure in Sandstone"/>
                        <div class="card-body">
                            <h5 class="card-title">Акция на Старый Новый Год</h5>
                            <p class="card-text">Акция на Старый Новый Год Акция на Старый Новый Год Акция на Старый Новый Год Акция на Старый Новый Год</p>
                            <a href="#!" data-mdb-ripple-init class="btn btn-primary">Принять участие</a>
                        </div>
                    </div>`;
        },
        cardBox: (cardUrl, balance) => {
            return `<div class="card" style="padding: 10px;">
                        <img src="${cardUrl}" class="card-img-top"/>
                        <div class="card-body">
                            <h4 class="card-title">Баланс: ${balance}</h4>
                        </div>
                    </div>`;
        }
    }

export {SelectApp}