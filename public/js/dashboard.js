'use strict';
/**
 * Wohoo my debut with vanilla js (tapi cuma sebagian -_-)
 */

//  knob animation
const globalDuration = 15;

// you already know from the variable name :)
const preloadContainer = document.querySelector('.preload-container');

/**
 * Sorting start
 */

//  buttons
const btnSortClose = document.querySelector('#sort__close');
const btnSortOpen = document.querySelector('.sort__btn');
const sortOverlay = document.querySelector('.sort__overlay');
const sortContainer = document.querySelector('.sort__container');
const btnFilter = document.querySelector('#filter');

// texts
const companyText = document.querySelector('#gen-company');
const farmText = document.querySelector('#gen-farm');
const afdellingText = document.querySelector('#gen-afdelling');
const yearText = document.querySelector('#gen-year');

const agencyText = document.querySelector('#info-agency');
const totalFarmText = document.querySelector('#info-farm');
const managerText = document.querySelector('#info-manager');
const totalAfdellingText = document.querySelector('#info-afdelling');
const assistantText = document.querySelector('#info-assistant');
const totalBlockText = document.querySelector('#info-block');
const foremanText = document.querySelector('#info-foreman');
const subforemanText = document.querySelector('#info-subforeman');

// input fields
const companyField = document.querySelector('#company');
const farmField = document.querySelector('#farm');
const afdellingField = document.querySelector('#afdelling');
const plantYearField = document.querySelector('#plant_year');

// kegiatan panen
const harvestingScroller = document.querySelector('#harvesting');

// charts id
const panenChart = document.querySelector('#panen');
const panenFarmChart = document.querySelector('#kebun');
const jobCompletenessBlock = document.querySelector('#target');
const trendActivities= document.querySelector('#trend-activities');

// filter buttons on charts element
const sortJobCompletenessBlock = document.querySelector('#job-completeness-block');
const sortTrend1 = document.querySelector('#sort-trend-1');
const sortTrend2 = document.querySelector('#sort-trend-2');

/**
 * Functions start
 */
const closeForm = function () {
    sortContainer.classList.remove('animate__fadeInUp');
    sortContainer.classList.add('animate__fadeOutDown');

    btnSortOpen.classList.add('animate__fadeInUp');

    sortOverlay.style.display = 'none';
    btnSortOpen.style.display = 'flex';
}

const openForm = function () {
    sortContainer.classList.remove('animate__fadeOutDown')
    btnSortOpen.classList.remove('animate__jello')
    sortContainer.classList.add('animate__fadeInUp')

    sortContainer.style.setProperty('--animate-duration', '.5s')
    btnSortOpen.style.display = 'none';
    sortOverlay.style.display = 'block';
    sortContainer.style.display = 'block';
}

const scroller = function (data) {
    // harvesting
    $({
            harvestingVal: 0
        })
        .animate({
            harvestingVal: data.harvesting,
        }, {
            duration: 950,
            easing: "swing",
            step: function () {
                $("#harvesting").text(Math.ceil(this.harvestingVal)).trigger("change");
            }
        });

    // average time harvest
    $({
            avgTime: 0
        })
        .animate({
            avgTime: data.detail[0],
        }, {
            duration: 950,
            easing: "swing",
            step: function () {
                $("#avg-time").text(Math.ceil(this.avgTime)).trigger("change");
            }
        });

    // total kg
    $({
            totalKg: 0
        })
        .animate({
            totalKg: data.detail[1],
        }, {
            duration: 950,
            easing: "swing",
            step: function () {
                $("#total-kg").text(Math.ceil(this.totalKg)).trigger("change");
            }
        });

    // hk
    $({
            hkWork: 0
        })
        .animate({
            hkWork: data.detail[2],
        }, {
            duration: 950,
            easing: "swing",
            step: function () {
                $("#hk-work").text(Math.ceil(this.hkWork)).trigger("change");
            }
        });
}

const knobs = function (data) {
    // spraying
    $({
            sprayingVal: 0
        })
        .animate({
            sprayingVal: data.spraying,
        }, {
            duration: data.spraying * globalDuration,
            easing: "swing",
            step: function () {
                $("#spraying").val(Math.ceil(this.sprayingVal)).trigger("change");
            }
        });
    // Fertilizer
    $({
            fertilizerVal: 0
        })
        .animate({
            fertilizerVal: data.fertilizer,
        }, {
            duration: data.fertilizer * globalDuration,
            easing: "swing",
            step: function () {
                $("#fertilizer").val(Math.ceil(this.fertilizerVal)).trigger("change");
            }
        });

    // Manual Circle
    $({
            circleVal: 0
        })
        .animate({
            circleVal: data.circle,
        }, {
            duration: data.circle * globalDuration,
            easing: "swing",
            step: function () {
                $("#circle").val(Math.ceil(this.circleVal)).trigger("change");
            }
        });

    // Pruning
    $({
            pruningVal: 0
        })
        .animate({
            pruningVal: data.pruning,
        }, {
            duration: data.pruning * globalDuration,
            easing: "swing",
            step: function () {
                $("#pruning").val(Math.ceil(this.pruningVal)).trigger("change");
            }
        });

    // Pest Control
    $({
            pcontrolVal: 0
        })
        .animate({
            pcontrolVal: data.pcontrol,
        }, {
            duration: data.spraying * globalDuration,
            easing: "swing",
            step: function () {
                $("#pcontrol").val(Math.ceil(this.pcontrolVal)).trigger("change");
            }
        });

    // Gawangan
    $({
            gawanganVal: 0
        })
        .animate({
            gawanganVal: data.gawangan,
        }, {
            duration: data.gawangan * globalDuration,
            easing: "swing",
            step: function () {
                $("#gawangan").val(Math.ceil(this.gawanganVal)).trigger("change");
            }
        });
}

const loadPanen = function (taksasi_result, harvesting_result) {
    if (window.load_panen != undefined)
        window.load_panen.destroy();
    
    load_panen = new Chart(ctx_load_panen, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sept', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Hasil Panen (Kg)',
                data: harvesting_result,
                backgroundColor: 'rgba(3, 169, 244, .7)',
                borderWidth: 1,
                borderColor: 'rgba(3, 169, 244, 1)',
                borderWidth: 1.5,
                hoverBackgroundColor: 'rgba(3, 169, 244, .6)',
            }, {
                label: 'Taksasi',
                data: taksasi_result,
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
}

const loadPanenOnFarm = function (afdelling = [], harvesting_result = []) {
    if (window.load_panen_farm != undefined)
        window.load_panen_farm.destroy();
    
    load_panen_farm = new Chart(ctx_load_panen_farm, {
        type: 'horizontalBar',
        data: {
            labels: afdelling,
            datasets: [{
                label: 'Hasil Panen (Kg)',
                data: harvesting_result,
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
}

const loadJobCompletenessBlock = function (blocks = [], target_coverage = [], result = []) {
    if (window.job_completeness_block != undefined)
        window.job_completeness_block.destroy();
    
    job_completeness_block = new Chart(ctx_job_completeness_block, {
        type: 'bar',
        data: {
            labels: blocks,
            datasets: [{
                label: 'Capaian (Ha)',
                data: result,
                backgroundColor: 'rgba(63, 81, 181, .7)',
                borderWidth: 1,
                borderColor: 'rgba(63, 81, 181, 1)',
                borderWidth: 1.5,
                hoverBackgroundColor: 'rgba(63, 81, 181, .6)',
            }, {
                label: 'Target Luasan (Ha)',
                data: target_coverage,
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
}

const loadTrendActivities = function (label1 = 'Not Selected', data1 = [], label2 = 'Not Selected', data2 = []) {
    if (window.trend_activities != undefined)
        window.trend_activities.destroy();
    
    trend_activities = new Chart(ctx_trend_activities, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sept', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: label1,
                data: data1,
                backgroundColor: 'rgba(63, 81, 181, .5)',
                borderWidth: 2,
                pointRadius: 3,
                borderColor: 'rgba(63, 81, 181, 1)',
            }, {
                label: label2,
                data: data2,
                backgroundColor: 'rgba(0, 150, 36, .5)',
                borderWidth: 2,
                pointRadius: 3,
                borderColor: 'rgba(0, 150, 36, 1)',
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
}

const sortTrendActivities = function () {
    if (isNaN(companyField.value) || isNaN(farmField.value) || isNaN(afdellingField.value)) {
        openForm();
    } else {
        preloadContainer.style.display = 'flex';
        sortTrend1.disabled = true;
        sortTrend2.disabled = true;

        const req = {
            afdelling: afdellingField.value,
            year: plantYearField.value,
            jobtype1: sortTrend1.value,
            jobtype2: sortTrend2.value,
        }
        axios.post(`/superadmin/dashboard/filter/trend`, req).then(response => {
            const data = response.data.data;
            loadTrendActivities(sortTrend1[sortTrend1.selectedIndex].text, data.activities.data1, sortTrend2[sortTrend2.selectedIndex].text, data.activities.data2)
        }).finally(() => {
            preloadContainer.style.display = "none";
            sortTrend1.disabled = false;
            sortTrend2.disabled = false;
        });
    }
}

/**
 * functions end
 */

// disable input field on start
farmField.disabled = true;
afdellingField.disabled = true;
plantYearField.disabled = true;
btnFilter.disabled = true;

/**
 * charts init with empty values
 */
var ctx_load_panen = panenChart.getContext('2d');
var load_panen = new Chart(ctx_load_panen, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sept', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Hasil Panen (Kg)',
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            backgroundColor: 'rgba(3, 169, 244, .7)',
            borderWidth: 1,
            borderColor: 'rgba(3, 169, 244, 1)',
            borderWidth: 1.5,
            hoverBackgroundColor: 'rgba(3, 169, 244, .6)',
        }, {
            label: 'Taksasi',
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
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

var ctx_load_panen_farm = panenFarmChart.getContext('2d');
var load_panen_farm = new Chart(ctx_load_panen_farm, {
    type: 'horizontalBar',
    data: {
        labels: [],
        datasets: [{
            label: 'Hasil Panen (Kg)',
            data: [],
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

var ctx_job_completeness_block = jobCompletenessBlock.getContext('2d');
var job_completeness_block = new Chart(ctx_job_completeness_block, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Capaian (Ha)',
            data: [],
            backgroundColor: 'rgba(63, 81, 181, .7)',
            borderWidth: 1,
            borderColor: 'rgba(63, 81, 181, 1)',
            borderWidth: 1.5,
            hoverBackgroundColor: 'rgba(63, 81, 181, .6)',
        }, {
            label: 'Target Luasan (Ha)',
            data: [],
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

var ctx_trend_activities = trendActivities.getContext('2d');
var trend_activities = new Chart(ctx_trend_activities, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sept', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Not Selected',
            data: [],
            backgroundColor: 'rgba(63, 81, 181, .5)',
            borderWidth: 2,
            pointRadius: 3,
            borderColor: 'rgba(63, 81, 181, 1)',
        }, {
            label: 'Not Selected',
            data: [],
            backgroundColor: 'rgba(0, 150, 36, .5)',
            borderWidth: 2,
            pointRadius: 3,
            borderColor: 'rgba(0, 150, 36, 1)',
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
 * init charts end
 */


window.onload = function () {  

    preloadContainer.style.display = 'none';

    btnSortOpen.addEventListener('mouseout', () => {
        if (btnSortOpen.classList.contains('animate__fadeInUp')) {
            btnSortOpen.classList.remove('animate__fadeInUp');
            btnSortOpen.classList.add('animate__jello');
        }
    });

    btnSortOpen.addEventListener('click', openForm);

    sortOverlay.addEventListener('click', closeForm);

    btnSortClose.addEventListener('click', closeForm);

    // pilih perusahaan
    companyField.addEventListener('change', () => {
        if (companyField.value) {
            axios.get(`/superadmin/dashboard/farms/${companyField.value}`)
                .then(response => {
                    const data = response.data.data;

                    farmField.innerHTML = '';
                    const option = document.createElement('option');
                    const optionText = document.createTextNode('Pilih kebun');
                    option.appendChild(optionText);
                    farmField.appendChild(option);

                    if (data.length > 0) {
                        farmField.disabled = false;

                        for (const d of data) {
                            const option = document.createElement('option');
                            const optionText = document.createTextNode(d.name);
                            option.setAttribute('value', d.id);
                            option.appendChild(optionText);
                            farmField.appendChild(option);
                        }
                    } else {
                        farmField.disabled = true;
                        afdellingField.disabled = true;
                        plantYearField.disabled = true;
                        plantYearField.value = '';
                        btnFilter.disabled = true;
                    }
                })
        } else {
            companyField.disabled = true;
        }

    });

    // pilih kebun
    farmField.addEventListener('change', () => {
        if (farmField.value) {
            axios.get(`/superadmin/dashboard/afdellings/${farmField.value}`)
                .then(response => {
                    const data = response.data.data;

                    afdellingField.innerHTML = '';
                    const option = document.createElement('option');
                    const optionText = document.createTextNode('Pilih afdelling');
                    option.appendChild(optionText);
                    afdellingField.appendChild(option);

                    if (data.length > 0) {
                        afdellingField.disabled = false;

                        for (const d of data) {
                            const option = document.createElement('option');
                            const optionText = document.createTextNode(d.name);
                            option.setAttribute('value', d.id);
                            option.appendChild(optionText);
                            afdellingField.appendChild(option);
                        }
                    } else {
                        afdellingField.disabled = true;
                        plantYearField.disabled = true;
                        plantYearField.value = '';
                        btnFilter.disabled = true;
                    }
                })
        } else {
            farmField.disabled = true;
        }

    });

    // pilih afdelling
    afdellingField.addEventListener('change', () => {
        if (!isNaN(afdellingField.value)) {
            plantYearField.disabled = false;
        } else {
            plantYearField.disabled = true;
            plantYearField.value = '';
            btnFilter.disabled = true;
        }
    });

    // input tahun tanam
    plantYearField.addEventListener('keyup', () => {
        if (plantYearField.value.length > 0) {
            btnFilter.disabled = false;
        } else {
            btnFilter.disabled = true;
        }
    });

    // klik tombol filter
    btnFilter.addEventListener('click', function (e) {
        e.preventDefault();
        
        preloadContainer.style.display = 'flex';
        this.innerText = 'Filtering...';
        const req = {
            company: companyField.value,
            farm: farmField.value,
            afdelling: afdellingField.value,
            year: plantYearField.value,
        }
        axios.post(`/superadmin/dashboard/filter`, req).then(response => {
            const data = response.data.data;

            companyText.innerText = data.general.company_name;
            farmText.innerText = data.general.farm;
            afdellingText.innerText = data.general.afdelling;
            yearText.innerText = plantYearField.value;

            agencyText.innerText = !data.agency[0]?.name ? '-' : data.agency[0].name;
            totalFarmText.innerText = !data.agency[0]?.total ? '-' : data.agency[0].total;

            managerText.innerText = !data.manager[0]?.name ? '-' : data.manager[0].name;
            totalAfdellingText.innerText = !data.manager[0]?.total ? '0' : data.manager[0].total;

            assistantText.innerText = !data.assistant[0]?.name ? '-' : data.assistant[0].name;
            totalBlockText.innerText = !data.assistant[0]?.total ? '0' : data.assistant[0].total;

            foremanText.innerText = data.foreman;
            subforemanText.innerText = data.subforeman;

            /**
             * scroller
             */
            scroller(data.harvest);

            /**
             * knobs
             */
            knobs(data.job_completeness);
            console.log(data.job_completeness);

            // panen
            loadPanen(data.panen[0], data.panen[1]);

            // panen each afdelling
            loadPanenOnFarm(data.panen_afdelling[0], data.panen_afdelling[1]);

            // ketuntasan pekerjaan masing" block
            loadJobCompletenessBlock(data.job_completeness_each_block[0], data.job_completeness_each_block[1], data.job_completeness_each_block[2])

        }).finally(() => {
            this.innerText = 'Filter';
            closeForm();
            preloadContainer.style.display = 'none';
        });
    });

    /**
     * Sorting end
     */
    //----------------------------------------------------------------//

    /**
     * Sorting jobtype start
     */

    sortJobCompletenessBlock.addEventListener('change', () => {
        if (isNaN(companyField.value) || isNaN(farmField.value) || isNaN(afdellingField.value)) {
            openForm();
        } else {
            preloadContainer.style.display = 'flex';
            sortJobCompletenessBlock.disabled = true;
            const req = {
                company: companyField.value,
                farm: farmField.value,
                afdelling: afdellingField.value,
                year: plantYearField.value,
                jobtype: sortJobCompletenessBlock.value,
            }
            axios.post(`/superadmin/dashboard/filter/completeness/block`, req).then(response => {
                const data = response.data.data;

                // ketuntasan pekerjaan masing" block
                loadJobCompletenessBlock(data.job_completeness_each_block[0], data.job_completeness_each_block[1], data.job_completeness_each_block[2])
            }).finally(() => {
                preloadContainer.style.display = "none";
                sortJobCompletenessBlock.disabled = false;
            });
        }
    });

    sortTrend1.addEventListener('change', sortTrendActivities);

    sortTrend2.addEventListener('change', sortTrendActivities);
    /**
     * sorting jobtype end
     */

    /**
     * Knob start
     */

    $('.knob').knob({
        'format': function (v) {
            return v + '%';
        }
    });
    /**
     * Knob end
     */
}
