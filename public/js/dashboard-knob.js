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