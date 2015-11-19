<div id="container"></div>

<script id="template" type="text/x-handlebars-template">
    <div class="row">
        {{#if this }}
        <div class="col-sm-3 col-md-3">
            <div class="thumbnail">
                <a href="{{this.url}}">
                    <img src="{{this.img_name}}" alt="{{this.name}}">
                </a>
            </div>
        </div>
        <div class="col-sm-9 col-md-9">
            <div class="caption">
                <h3>{{this.name}}</h3>
                {{#ifCond type.name '==' 'route'}}
                <p>Τύπος: Διαδρομή</p>
                {{/ifCond}}
                {{#ifCond type.name '==' 'location'}}
                <p>Τύπος: Καταγραφή σημείου στο χάρτη </p>
                {{/ifCond}}
                <p>Ημερομηνία δημιουργίας: {{ this.creation }}</p>
                {{#if this.description }}
                <p>Περιγραφή: {{this.description }}</p>
                {{/if}}
                <p class="small text-right">12 contributors</p>
            </div>
            <div class="text-right">
            <a href="{{ this.editUrl }}" class="btn btn-success"> Επεξεργασία</a>
            <button onclick="destroyMission({{ this.id }})" class="btn btn-danger">Διαγραφή</button>
            </div>
        </div>
        {{else}}
        <div class="col-sm-12 col-md-12">
            <p>Η αποστολή δεν βρέθηκε</p>
        </div>
        {{/if}}
    </div>
</script>
