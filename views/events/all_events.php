<section class="events">
    {calendar}
    <h1 class="blockTitle">События {namemon}</h1>
    <div class="events__wrap">
        <div class="wrap ">
            <div class="events__wrap--slider" id="centered" style="overflow: hidden;">
                <ul class="clearfix sly">
                    {event}
                </ul>
            </div>
            <div class="scrollbar">
                <div class="handle">
                    <div class="mousearea"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script  type="text/javascript">
    var sly = new Sly( '.scrollbar');
    sly.init();
    sly.reload();
</script>