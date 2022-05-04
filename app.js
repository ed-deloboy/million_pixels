
        let randomBlockContainer = document.getElementById('pixelsContainer');
        let blocks = document.querySelectorAll('.pixel_item');
        let pixelImgs = document.querySelectorAll('.pixel__img');
        // MODAL
        let firstModal = document.getElementById('firstModal');
        let spinner = document.querySelector('.spinner-grow');
        // filter select
        let filterCatSelect = document.getElementById('filterCatSelect');
        let outItemsArr = [];
        let filterOutArr = [];
        let fullArrFilterItems = {};


        // https://jsonplaceholder.typicode.com/photos - массив фото

        // получаю картинки и загружаю в src (для теста)
        // const loadPrevievImg = () => {
        // randomBlockContainer.classList.add('d-none');
        //     $.ajax({
        //         url: "https://jsonplaceholder.typicode.com/photos",
        //         method: 'GET',
        //         success: function (response) {
        //             for (let i = 0; i < 200; i++) {
        //                 if (response) {
        //                     spinner.classList.add('d-none');
        //                     randomBlockContainer.classList.remove('d-none');
        //                     pixelImgs.forEach((e, i) => {
        //                         e.setAttribute('src', response[i]['url'])
        //                     })
        //                 }
        //             }
        //         }
        //     });

        // }
        // loadPrevievImg()



        $(document).ready(function () {

            // обязательно скрипт должен быть запущен по готовности, так как изначально на долю секунд отрисовывается в виде полос
            randomBlockContainer.classList.remove('d-none');


            ///присваиваем id категории и id для БД для span
            blocks.forEach((e, i) => {
                // присваиваем id категории
                let categId = Math.round(Math.random() * 3)
                e.setAttribute('data-category', categId)
                // просто id
                e.setAttribute('data-id', i);

                // задаем элементам слассы и id для модалок
                e.setAttribute('data-bs-toggle', 'modal');
                e.setAttribute('data-bs-target', '#firstModal');

                // вписываем размер во внутрь

                // let pix = document.createElement('p')
                // e.append(pix)
                // pix.style.fontSize = '14px'
                // pix.style.marginTop = '10%'
                // pix.classList.add('text-center', 'text-wrap')
                // pix.textContent = `${$(e).width()} x ${$(e).height()}`

            })


            // функция срабатывает при перезагрузке и рандомизирует позицию блока
            const addRandomItems = () => {
                blocks.forEach((e, i) => {
                    outItemsArr.push(e)
                })
                outItemsArr.sort(() => {
                    return Math.random() - 0.5;
                })

                for (let i = 0; i < outItemsArr.length; i++) {
                    randomBlockContainer.append(outItemsArr[i])
                }
            }
            // запускаем рандомайз
            addRandomItems();


            // фильтр выпадающий список
            filterCatSelect.addEventListener('change', e => {
                let filterValue = e.target.value;

                // на фронте
                outItemsArr = [];
                blocks.forEach((e, i) => {
                    if (e.dataset.category == filterValue) {
                        outItemsArr.push(e)
                    }
                    else if (filterValue == 999) {
                        outItemsArr.push(e)
                    }
                });
                while (randomBlockContainer.firstChild) {
                    randomBlockContainer.removeChild(randomBlockContainer.firstChild);
                }
                for (let i = 0; i < outItemsArr.length; i++) {
                    randomBlockContainer.append(outItemsArr[i])
                }


                // через сервак 
                // $.ajax({
                //     url: "filter.php",
                //     method: 'POST',
                //     data: { filterValue: filterValue},
                //     success: function (response) {
                //         blocks.forEach(e => {
                //             e.classList.add('d-none');
                //             if (e.dataset.category == response) {
                //                 e.classList.remove('d-none');
                //             }
                //             else if (response == 999) {
                //                 e.classList.remove('d-none');
                //             }
                //         });
                //     }
                // });


            })


            //    masonry init - инициализация и настройки библиотеки кирпичной кладки
            let masonry = document.querySelector('.pixels_container');
            var msnry = new Masonry(masonry, {
                columnWidth: '.pixel_gray',
                itemSelector: '.pixel_item',
                gutter: 2,
                fitWidth: true,
            })

        });
