<div id="container" ></div>

<script id="template" type="text/x-handlebars-template">
    <div class="row">
        {{#each missions}}
        <div class="col-sm-3 col-md-3">
            <div class="thumbnail">
                <a href="#">
                    <img src="http://city-r-us-web/img/mission.png" alt="{{this.name}}">
                </a>
                <div class="caption">
                    <h3>{{this.name}}</h3>
                    {{#ifCond type.name '==' 'route'}}
                    <p>Τύπος: Διαδρομή</p>
                    {{/ifCond}}
                    {{#ifCond type.name '==' 'location'}}
                    <p>Τύπος: Καταγραφή σημείου στο χάρτη </p>
                    {{/ifCond}}
                    <p class="small text-right">12 contributors</p>
                </div>
            </div>
        </div>
        {{/each}}
    </div>
</script>
