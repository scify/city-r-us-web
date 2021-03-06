@extends('template.public.default')

@section('title')
{{ trans('home_default.terms') }}

@stop

@section('headerScripts')
<link href="{{ asset('plugins/pace-master/themes/blue/pace-theme-flash.css')}}" rel="stylesheet"/>
<link href="{{ asset('/plugins/uniform/css/uniform.default.min.css')}}" rel="stylesheet"/>
<link href="{{ asset('/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css">
<link href="{{ asset('/css/template/public/common.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/home/landing.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/custom.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('footerScripts')
<script src="{{ asset('/plugins/pace-master/pace.min.js')}}"></script>
<script src="{{ asset('/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('/plugins/uniform/jquery.uniform.min.js')}}"></script>
<script src="{{ asset('/plugins/tabstylesinspiration/js/cbpfwtabs.js')}}"></script>
<script src="{{ asset('/plugins/pricing-tables/js/main.js')}}"></script>
<script src="{{ asset('/js/pages/home/landing.js')}}"></script>
@stop

@section('bodyContent')
@include('template.public.topBar',["navClass" => 'navbar-fixed-top whiteHeader', "active" => "tac"])



<div id="termsAndConditions">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <p><h3>Πολιτική Προστασίας Προσωπικών Δεδομένων και Απορρήτου</h3>

                <p>Η SciFY δημιούργησε τον παρόντα Διαδικτυακό Τόπο με μοναδικό σκοπό την εξυπηρέτηση των χρηστών της
                    εφαρμογής City­R­Us. Οι παρακάτω Όροι και Προϋποθέσεις είναι δεσμευτικοί για όλους του χρήστες της
                    εφαρμογής και αποτελούν μέρος του παρόντος ιστότοπου.</p>
                <p>Πολιτκή της SciFY είναι ο σεβασμός και η προστασία του δικαιώματος των χρηστών στο απόρρητο, συνεπώς οι
                    πληροφορίες που συλλέγονται και αποθηκεύονται από τη SciFY συμμορφώνονται με το εφαρμοστέο δίκαιο και
                    έχουν στόχο να εμπλουτίσουν το περιεχόμενο και να διευρύνουν τις δυνατότητες της εφαρμογής
                    City­R­Us.<br/>
                    Η SciFY δεν πουλάει ούτε μεταβιβάζει σε τρίτους (εταιρείες, οργανισμούς κλπ) τα στοιχεία προσωπικού
                    χαρακτήρα, τις ηλεκτρονικές διευθύνσεις ή οποιαδήποτε άλλη πληροφορία που αφορά τους χρήστες της
                    εφαρμογής, με εξαίρεση την εφαρμογή σχετικών νομικών υπαγορεύσεων, δικαστικών αποφάσεων ή διοικητικών
                    αρχών και προς τις αρμόδιες και μόνο αρχές. Συνεπώς είναι σημαντικό για τους χρήστες να γνωρίζουν πως η
                    SciFY συλλέγει, αποθηκεύει και κοινοποιεί τις προσωπικές πληροφορίες των χρηστών που παρέχονται με τη
                    συγκατάθεσή τους.</p>

                <h4>Συλλογή Χρήση των Πληροφοριών</h4>

                <p>Η SciFY συλλέγει ορισμένους τύπους πληροφοριών προσωπικής ταυτοποίησης των χρηστών της εφαρμογής
                    City­R­Us, όπως η ηλεκτρονική διεύθυνση, το όνομα χρήστη, πληροφορίες σχετικά με την τοποθεσία του
                    χρήστη για συγκεκριμένο χρονικό διάστημα και η ταυτότητα συσκευής. Οι παραπάνω πληροφορίες συλλέγονται
                    και αποθηκεύονται σε διακομιστές περιορισμένης πρόσβασης της SciFY που ελέγχονται με κωδικούς πρόσβασης
                    και παραμένουν αυστηρά εμπιστευτικές.<br/>
                    Από τα παραπάνω προσωπικά δεδομένα, το όνομα χρήστη και η τοποθεσία κοινοποιούνται στους υπόλοιπους
                    χρήστες της εφαρμογής για λόγους που αφορούν στο σκοπό λειτουργίας της εφαρμογής City-R­-Us, δηλαδή για
                    την υπόδειξη συγκεκριμένης διαδρομής ή συγκεκριμένης τοποθεσίας στο χάρτη που προτείνει συγκεκριμένος
                    χρήστης της εφαρμογής.</p>

                <h4>Διόρθωση Τροποποίηση ή Διαγραφή Πληροφοριών</h4>

                <p>Η SciFY επιτρέπει στους χρήστες της εφαρμογής City­R­Us να διορθώνουν, αλλάζουν, συμπληρώνουν ή να
                    διαγράφουν δεδομένα και πληροφορίες που έχουν προσκομιστεί. Εάν επιλέξετε να διαγράψετε μια πληροφορία,
                    η SciFY θα ενεργήσει έτσι ώστε να διαγραφεί αυτή η πληροφορία από τα αρχεία της άμεσα.<br/>
                    Για τη προστασία και την ασφάλεια του χρήστη η SciFY θα προσπαθήσει να βεβαιωθεί ότι το πρόσωπο που
                    κάνει τις αλλαγές είναι όντως το ίδιο πρόσωπο με το χρήστη. Για να έχετε πρόσβαση, να αλλάξετε ή να
                    διαγράψετε τα προσωπικά σας δεδομένα, για να αναφέρετε προβλήματα σχετικά με τη λειτουργία της
                    ιστοσελίδας ή για να κάνετε οποιοδήποτε ερώτημα επικοινωνήστε με την SciFY μέσω <a href="http://www.scify.gr" target="_blank">www.scify.gr</a> ή μέσω
                    e­mail στην ηλεκτρονική διεύθυνση <a href="mailto:info@scify.org">info@scify.gr</a>.</p>

                <h4> Αλλαγές στην παρούσα Πολιτική Απορρήτου</h4>

                <p>Η SciFY μπορεί να αναθεωρήσει την παρούσα Πολιτική Απορρήτου με την πάροδο του χρόνου, καθώς προστίθενται
                    στον Ιστότοπο νέα χαρακτηριστικά ή καθώς εξελίσσεται η νομοθεσία και τα πρότυπα για το Διαδίκτυο, και
                    αυτό θα είναι εμφανές στην ένδειξη «Τελευταία Τροποποίηση» παρακάτω. Θα αναρτούμε τις εν λόγω αλλαγές σε
                    περίβλεπτη θέση, αλλά συστήνουμε στους χρήστες της εφαρμογής να διαβάζουν ανά διαστήματα την παρούσα
                    Πολιτική Απορρήτου όταν επισκέπτονται τον Ιστότοπο. Οι αλλαγές δεν θα ισχύουν αναδρομικά για τις
                    Προσωπικές Πληροφορίες που έχουν συλλεγεί πριν την πραγματοποίηση αλλαγών στην Πολιτική Απορρήτου, εκτός
                    και αν κάτι τέτοιο απαιτείται από τη νομοθεσία.</p>

                <p class="last_modified"><em>Τελευταία Τροποποίηση: 08/01/2016</em></p>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <p class="text-center no-s">2015 &copy; SciFY | <a href="{{ url('termsAndConditions') }}">{{ trans('home_default.termsAndConditions') }}</a> | <a href="https://commons.wikimedia.org/wiki/File:Athens_-_Monastiraki_square_and_station_-_20060508.jpg" target="_blank">{{ trans('home_default.imageSrc') }}</a></p>
    </div>
    <div class="container text-center">
        <p class=" no-s">{{ trans('home_default.funding') }}</p>
        <a href="http://www.radical-project.eu/" target="_blank"><img src="{{ asset('img/radical_logo.jpg') }}"></a>
        <img src="{{ asset('img/commission_europeenne_logo.jpg') }}">
    </div>
</footer>
@stop
