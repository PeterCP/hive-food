const toggleSection = (function () {

// MODEL

    const Section = Immutable.Map({
        menu: "menu",
        createForm: "createForm"
    });

    const InitialModel = Immutable.Map({
        visible: Section.get("menu"),
        buttonText: "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
    });

    let history = Immutable.List([InitialModel]);

//UPDATE

    const Msg = Immutable.Map({
        displayMenu: "displayMenu",
        displayCreateForm: "displayCreateForm"
    });


    function update(msg) {

        switch (msg) {
            case Msg.get("displayMenu"):
                history = history.push(history.last().set('visible', Section.get('menu')));
                history = history.push(history.last().set('buttonText', "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"));
                break;
            case Msg.get("displayCreateForm"):
                history = history.push(history.last().set('visible', Section.get('createForm')));
                history = history.push(history.last().set('buttonText', "&nbsp;&nbsp;&nbsp;Regresar&nbsp;&nbsp;&nbsp;"));
                break;
        }

        view(history.last());
    }

//VIEW

    function view(model) {
        //console.log(model.toJSON());

        const displayMenuAndFormButton = document.querySelector("#displayMenuAndFormButton");
        const dishes = document.querySelector("#dishes");
        const create_menu = document.querySelector("#create_menu");

        switch (model.get('visible')) {
            case Section.get("menu"):
                displayMenuAndFormButton.dataset.msg = Msg.get("displayCreateForm");
                displayMenuAndFormButton.classList.remove('btn-warning');
                displayMenuAndFormButton.classList.add('btn-success');

                dishes.classList.remove('hidden');
                create_menu.classList.add('hidden');
                break;
            case Section.get("createForm"):
                displayMenuAndFormButton.dataset.msg = Msg.get("displayMenu");
                displayMenuAndFormButton.classList.remove('btn-success');
                displayMenuAndFormButton.classList.add('btn-warning');
                create_menu.classList.remove('hidden');
                dishes.classList.add('hidden');
                break;
        }

        const buttonText = model.get('buttonText');
        displayMenuAndFormButton.innerHTML = buttonText;

    }

    return {
        update: update
    }

})();


