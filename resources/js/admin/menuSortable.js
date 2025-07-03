function initNestedSortable(el) {
        Sortable.create(el, {
            group: 'nested',
            animation: 150,
            fallbackOnBody: true,
            swapThreshold: 0.65,
            handle: '.menu-item',
            onEnd: () => console.log("Orden modificado")
        });

        el.querySelectorAll('ul').forEach(ul => initNestedSortable(ul));
    }

    initNestedSortable(document.getElementById('menu-list'));

    document.getElementById('saveOrder').addEventListener('click', function () {
        const data = serialize(document.querySelector('#menu-list'));

        fetch(window.appRoutes.Admin_Menus_Reorder, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': window.appRoutes.csrfToken
            },
            body: JSON.stringify({ tree: data })
        }).then(res => res.json())
          .then(data => alert(data.message));
    });

    function serialize(list, parentId = null) {
        const items = [];
        list.querySelectorAll(':scope > li').forEach((li, index) => {
            const itemId = li.dataset.id;
            const childList = li.querySelector(':scope > ul');

            items.push({
                id: itemId,
                order: index + 1,
                parent_id: parentId,
                children: childList ? serialize(childList, itemId) : []
            });
        });
        return items;
    }