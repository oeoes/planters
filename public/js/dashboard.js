'use strict';
/**
 * Wohoo my debut with vanilla js (tapi cuma sebagian -_-)
 */

window.onload = () => {
    document.querySelector('.preload-container').style.display = 'none';
    /**
     * Sorting start
     */
    const btnSortClose = document.querySelector('#sort__close');
    const btnSortOpen = document.querySelector('.sort__btn');
    const sortOverlay = document.querySelector('.sort__overlay');
    const sortContainer = document.querySelector('.sort__container');

    // fields
    const companyField = document.querySelector('#company');
    const farmField = document.querySelector('#farm');
    const afdellingField = document.querySelector('#afdelling');
    const plantYearField = document.querySelector('#plant_year');

    btnSortOpen.addEventListener('mouseout', () => {
        if (btnSortOpen.classList.contains('animate__fadeInUp')) {
            btnSortOpen.classList.remove('animate__fadeInUp');
            btnSortOpen.classList.add('animate__jello');
        }
    });

    btnSortOpen.addEventListener('click', () => {
        sortContainer.classList.remove('animate__fadeOutDown')
        btnSortOpen.classList.remove('animate__jello')
        sortContainer.classList.add('animate__fadeInUp')

        sortContainer.style.setProperty('--animate-duration', '.5s')
        btnSortOpen.style.display = 'none';
        sortOverlay.style.display = 'block';
        sortContainer.style.display = 'block';
    });

    sortOverlay.addEventListener('click', () => {
        sortContainer.classList.remove('animate__fadeInUp');
        sortContainer.classList.add('animate__fadeOutDown');

        btnSortOpen.classList.add('animate__fadeInUp');

        sortOverlay.style.display = 'none';
        btnSortOpen.style.display = 'flex';
    });

    btnSortClose.addEventListener('click', () => {
        sortContainer.classList.remove('animate__fadeInUp');
        sortContainer.classList.add('animate__fadeOutDown');

        btnSortOpen.classList.add('animate__fadeInUp');

        sortOverlay.style.display = 'none';
        btnSortOpen.style.display = 'flex';
    });

    // pilih perusahaan
    companyField.addEventListener('change', () => {

    });

    /**
     * Sorting end
     */
    //----------------------------------------------------------------//

    /**
     * Knob start
     */

    const globalDuration = 15;

    $('.knob').knob({
        'format': function (v) {
            return v + '%';
        }
    });

    // ketuntasan panen
    $({panenVal: 0})
    .animate({
        panenVal: $('#ketuntasan-panen').attr('value'),
    }, {
        duration: parseInt($('#ketuntasan-panen').attr('value')) * globalDuration,
        easing: "swing",
        step: function () {
            $("#ketuntasan-panen").val(Math.ceil(this.panenVal)).trigger("change");
        }
    });

    // Spraying
    $({sprayingVal: 0})
    .animate({
        sprayingVal: $('#spraying').attr('value'),
    }, {
        duration: $('#spraying').attr('value') * globalDuration,
        easing: "swing",
        step: function () {
            $("#spraying").val(Math.ceil(this.sprayingVal)).trigger("change");
        }
    });

    // Fertilizer
    $({fertilizerVal: 0})
    .animate({
        fertilizerVal: $('#fertilizer').attr('value'),
    }, {
        duration: $('#fertilizer').attr('value') * globalDuration,
        easing: "swing",
        step: function () {
            $("#fertilizer").val(Math.ceil(this.fertilizerVal)).trigger("change");
        }
    });

    // Manual Circle
    $({circleVal: 0})
    .animate({
        circleVal: $('#circle').attr('value'),
    }, {
        duration: $('#circle').attr('value') * globalDuration,
        easing: "swing",
        step: function () {
            $("#circle").val(Math.ceil(this.circleVal)).trigger("change");
        }
    });

    // Pruning
    $({pruningVal: 0})
    .animate({
        pruningVal: $('#pruning').attr('value'),
    }, {
        duration: $('#pruning').attr('value') * globalDuration,
        easing: "swing",
        step: function () {
            $("#pruning").val(Math.ceil(this.pruningVal)).trigger("change");
        }
    });

    // Pest Control
    $({pcontrolVal: 0})
    .animate({
        pcontrolVal: $('#pcontrol').attr('value'),
    }, {
        duration: $('#pcontrol').attr('value') * globalDuration,
        easing: "swing",
        step: function () {
            $("#pcontrol").val(Math.ceil(this.pcontrolVal)).trigger("change");
        }
    });

    // Gawangan
    $({gawanganVal: 0})
    .animate({
        gawanganVal: $('#gawangan').attr('value'),
    }, {
        duration: $('#gawangan').attr('value') * globalDuration,
        easing: "swing",
        step: function () {
            $("#gawangan").val(Math.ceil(this.gawanganVal)).trigger("change");
        }
    });

    /**
     * Knob end
     */

    //----------------------------------------------------------------//

    /**
     * Chart start
     */

    var ctx1 = document.getElementById('panen').getContext('2d');
    var myChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sept', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Hasil Panen',
                data: [12, 19, 3, 5, 2, 3, 7, 9, 2, 3, 7, 8],
                backgroundColor: 'rgba(3, 169, 244, .7)',
                borderWidth: 1,
                borderColor: 'rgba(3, 169, 244, 1)',
                borderWidth: 1.5,
                hoverBackgroundColor: 'rgba(3, 169, 244, .6)',
            }, {
                label: 'Taksasi',
                data: [12, 20, 4, 8, 5, 5, 7, 10, 5, 5, 7, 8],
                backgroundColor: 'rgba(63, 81, 181, .8)',
                hoverBackgroundColor: 'rgba(63, 81, 181, .9)',
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 6,
                pointStyle: 'rect',
                fill: false,
                type: 'line',
                lineTension: 0
            }, ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    }
                }]
            }
        }
    });

    var ctx = document.getElementById('kebun').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: ['West-01', 'West-02', 'West-03', 'West-04', 'West-05', 'West-06', 'West-07', 'West-08', 'West-09', 'West-10'],
            datasets: [{
                label: 'Hasil Panen',
                data: [2, 3, 3, 4, 5, 6, 7, 8, 9, 10],
                backgroundColor: 'rgba(139, 195, 74, .7)',
                borderWidth: 1,
                borderColor: 'rgba(139, 195, 74, 1)',
                borderWidth: 1.5,
                hoverBackgroundColor: 'rgba(139, 195, 74, .6)',
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx2 = document.getElementById('target').getContext('2d');
    var myChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['AF-10', 'AF-11', 'AF-12', 'AF-13', 'AF-14', 'AF-15', 'AF-16', 'AF-17', 'AF-18', 'AF-19', 'AF-20', 'AF-21'],
            datasets: [{
                label: 'Capaian',
                data: [12, 19, 3, 5, 2, 3, 7, 9, 2, 3, 7, 8],
                backgroundColor: 'rgba(63, 81, 181, .7)',
                borderWidth: 1,
                borderColor: 'rgba(63, 81, 181, 1)',
                borderWidth: 1.5,
                hoverBackgroundColor: 'rgba(63, 81, 181, .6)',
            }, {
                label: 'Target Luasan',
                data: [12, 20, 4, 8, 5, 5, 7, 10, 5, 5, 7, 8],
                backgroundColor: 'rgba(233, 30, 99, 1)',
                hoverBackgroundColor: 'rgba(233, 30, 99, .8)',
                borderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 6,
                pointStyle: 'rect',
                fill: false,
                type: 'line',
                lineTension: 0
            }, ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    }
                }]
            }
        }
    });


    var ctx3 = document.getElementById('trend-activities').getContext('2d');
    var myChart = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sept', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Spraying',
                data: [12, 19, 3, 5, 2, 3, 7, 9, 2, 3, 7, 8],
                backgroundColor: 'rgba(63, 81, 181, .2)',
                borderWidth: 2,
                pointRadius: 3,
                borderColor: 'rgba(63, 81, 181, 1)',
            }, {
                label: 'Fertilizer',
                data: [12, 15, 4, 8, 5, 5, 4, 10, 5, 5, 7, 8],
                backgroundColor: 'rgba(0, 150, 36, .2)',
                borderWidth: 2,
                pointRadius: 3
            }, ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    }
                }]
            }
        }
    });

    /**
     * Chart end
     */
}
