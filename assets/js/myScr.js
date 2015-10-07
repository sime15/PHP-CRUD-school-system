
$(document).ready(function(e) {

    /* 1 - sambitovanje formi modala */
    $('.btn-submit').off().click(function(e){
        e.preventDefault();
        var form = $('#' + $(this).data('formid'));
        form.submit();
    });

    /* 2 - unos novog ucenika koriscenjem AJAX tehnologije; podaci koji se salju na server se kupe iz forme modala;
    * podaci koji se vracaju su u JSON formatu; na osnovu klase alerta se ispituje odziv sa servera; ako je unos uspjesan
    * prikazuje se odgovarajuca notifikacija i vrsi se redirekcija na home page nakon 2 sekunde; u suprotnom se prikazuje
    * notifikacija da zatjevana polja nisu popunjena ili da unos u bazu nije uspio*/
    $('.btn-submit-new').off().click(function(e){
        e.preventDefault();

        var url_ajax = 'http://jpdesign.ba/sime_test/ucenici/components/new_student.php';

        $.ajax({
            url: url_ajax,
            type: 'POST',
            async: true,
            data: {name: $('#name').val(),surname:$('#surname').val(),years:$('#years').val(),schools: $('#schools').val()},
            dataType  : "json",
            cache: false,
            success: function(response) {
                console.log(response);

                if(response["alert-class"] == 'alert-success')
                {
                    $('#message').html(response["alert-message"]);
                    $('.unos-ucenika').removeClass("alert-error alert-warning").addClass(response["alert-class"]).css('display','block');
                    setTimeout(function(){window.location.href = "http://jpdesign.ba/sime_test/ucenici/index.php"},2000);
                }
                else
                {
                    $('#message').html(response["alert-message"]);
                    $('.unos-ucenika').addClass(response["alert-class"]).css('display','block');
                }
            }

        });
    });

    /* 3 - podizanje modala za editovanje ucenika i popunjavanje polja forme modala trenutnim podacima; nakom izmjene
    * podataka i sabmitovanja podataka forma modala se sabmituje "sama u sebe", novi podaci su proslijedjeni POST metodom,
    * "pokupljeni" u fajlu index.php i uneseni u bazu */
    $('.btn-edit-student').off().click(function(e){
        e.preventDefault();

        $('#name-edit').val($(this).data('name'));
        $('#surname-edit').val($(this).data('surname'));
        $('#years-edit').val($(this).data('years'));
        $('#schools-edit').val($(this).data('school'));
        $('#student-id').val($(this).data('id'));

        $('#editStudentModal').modal('show');
    });

    /* 4 - podizanje modala za brisanje ucenika; nakon potvrde za brisanje ucenika iz evidencije forma modala se
    * sabmituje "sama u sebe", id odgovarajuceg ucenika je kao 'hidden' proslijedjen POST metodom,"pokupljen" u fajlu
    * index.php i u tom fajlu je izvrseno brisanje ucenika iz baze */
    $('.btn-delete-student').off().click(function(e){
        e.preventDefault();
        $('#id-delete').val($(this).data('id'));

        $('#deleteStudentModal').modal('show');
    });

    /* 5 - podizanje modala za editovanje skole i popunjavanje polja forme modala trenutnim podacima; nakom izmjene
    * podataka i sabmitovanja podataka forma modala se sabmituje "sama u sebe", novi podaci su proslijedjeni POST metodom,
    * "pokupljeni" u fajlu skole.php i uneseni u bazu */
    $('.btn-edit-school').off().click(function(e){
        e.preventDefault();

        $('#name-edit').val($(this).data('name'));
        $('#jib-edit').val($(this).data('jib'));
        $('#address-edit').val($(this).data('address'));
        $('#phone-edit').val($(this).data('phone'));
        $('#id').val($(this).data('id'));

        $('#editSchoolModal').modal('show');
    });

    /* 6 - podizanje modala za brisanje skole; nakon potvrde za brisanje skole iz evidencije forma modala se
    * sabmituje "sama u sebe", id odgovarajuce skole je kao 'hidden' proslijedjen POST metodom,"pokupljen" u fajlu
    * skole.php i u tom fajlu je izvrseno brisanje skole iz baze */
    $('.btn-delete-school').off().click(function(e){
        e.preventDefault();
        $('#delete-id').val($(this).data('id'));

        $('#deleteSchoolModal').modal('show');
    });

    /* 7 - koriscenje AJAX tehnologije za pretragu ucenika; podatak koji se salje na server je ukucani string; podaci
    * koji se vracaju (u JSON formatu) su spisak ucenika koji odgovara pretrazi ili string 'no-results' ukoliko nije
    * pronadjen nijedan ucenik; ukoliko ima ucenika koji odgovaraju pretrazi prije sabmitovanja teksta za pretragu
    * prikazuje se dropdown menu sa imenima tih ucenika koja su linkovana na stranice sa detaljima ucenika*/
    $('#search-term-ucenici').off().on("propertychange keyup input paste",function(e) {

        var url_ajax = 'http://jpdesign.ba/sime_test/ucenici/components/search_ucenici.php';

        $.ajax({
            url: url_ajax,
            type: 'POST',
            async: true,
            data: {search_term: $(this).val()},
            dataType  : "json",
            cache: false,
            success: function(response) {
                console.log(response);
                if(response != null && response.length != 0)
                {
                    if(response[0] != "no-results")
                    {
                        var list_items = '';
                        for(var i=0; i< response.length; i++)
                        {
                            list_items += '<li><a href="http://jpdesign.ba/sime_test/ucenici/details_ucenici.php?id='+ response[i].ucenik_id + '">' + response[i].ucenik_ime + ' ' + response[i].ucenik_prezime + '</a></li>';
                        }
                        $('#search-result-list').empty();
                        $('#search-result-list').html(list_items);
                        $('#search-results').css('display','block');
                    }
                    else
                    {
                        $('#search-result-list').empty();
                        $('#search-results').css('display','none');
                    }
                }
                else
                {
                    $('#search-result-list').empty();
                    $('#search-results').css('display','none');
                }
            },
            error: function(response){
                console.log("Error: "+response);
            }
        });

    });

    /* 8 - koriscenje AJAX tehnologije za pretragu skola; podatak koji se salje na server je ukucani string; podaci
     * koji se vracaju (u JSON formatu) su spisak skola koji odgovara pretrazi ili string 'no-results' ukoliko nije
     * pronadjena nijedna skola; ukoliko ima skola koji odgovaraju pretrazi prije sabmitovanja teksta za pretragu
     * prikazuje se dropdown menu sa sa imenima tih skola koja su linkovana na stranice sa detaljima skola*/
    $('#search-term-skole').off().on("propertychange keyup input paste",function(e) {

        var url_ajax = 'http://jpdesign.ba/sime_test/ucenici/components/search_skole.php';

        $.ajax({
            url: url_ajax,
            type: 'POST',
            async: true,
            data: {search_term: $(this).val()},
            dataType  : "json",
            cache: false,
            success: function(response) {
                console.log(response);
                if(response != null && response.length != 0)
                {
                    if(response[0] != "no-results")
                    {
                        var list_items = '';
                        for(var i=0; i< response.length; i++)
                        {
                            list_items += '<li><a href="http://jpdesign.ba/sime_test/ucenici/details_skole.php?id='+ response[i].skola_id + '">' + response[i].skola_naziv + '</a></li>';
                        }
                        $('#search-result-list').empty();
                        $('#search-result-list').html(list_items);
                        $('#search-results').css('display','block');
                    }
                    else
                    {
                        $('#search-result-list').empty();
                        $('#search-results').css('display','none');
                    }
                }
                else
                {
                    $('#search-result-list').empty();
                    $('#search-results').css('display','none');
                }
            },
            error: function(response){
                console.log("Error: "+response);
            }
        });

    });

    /* 9 - prosljedjivanje stringa za pretragu GET metodom ukoliko je nakon unosa pritisnut enter ( ==13); pretraga
    * nezavisna od AJAX poziva; obavlja se u fajlovima index.php i skole.php trazenjem stringa za pretragu u odgovarajucim
    * tabelama u bazi*/
    $('.submitEnter').keypress(function(e) {
        if(e.which == 13) {
            if($(this).val() != '')
                window.location.href = $(this).data('url') + '?search=' + $(this).val();
            else
                window.location.href = $(this).data('url');
        }
    });

    /* 10 - koriscenje AJAX tehnologije za ucitavanje ucenika jedne skole na stranici za detalje skole; ponovno definisanje
    * eventa koji odgovaraju selektorima $('.btn-edit-student') i $('.btn-delete-student') zbog njihovog naknadnog ucitavanja
    * na stranicu (na ovaj nacin se ozivljavaju opcije edit i delete za novoucitane ucenike); kod oba modala izmjena action
    * atributa da bi se sabmit formi obavio na stranicu na kojoj su ucenici i ucitani, a to je stranica sa detaljima te skole*/
    $('#btn-read-students').off().click(function(e){

        e.preventDefault();
        $('#students-table').empty();
        $('#loading').css('display','block');
        $.ajax({
            url : "http://jpdesign.ba/sime_test/ucenici/components/read_students.php",
            type: "POST",
            data: {skola_id : $(this).data('id')},
            dataType  : "text",
            cache: false,
            success: function(response){
                console.log(response);
                $('#loading').css('display','none');
                $('#students-table').html(response);

                $('.btn-edit-student').off().click(function(e){
                    e.preventDefault();

                    $('#name-edit').val($(this).data('name'));
                    $('#surname-edit').val($(this).data('surname'));
                    $('#years-edit').val($(this).data('years'));
                    $('#schools-edit').val($(this).data('school'));
                    $('#student-id').val($(this).data('id'));

                    $('#editStudentModal').modal('show');

                    $("form").attr("action","http://jpdesign.ba/sime_test/ucenici/details_skole.php?id=" +  $('#schools-edit').val());
                });

                $('.btn-delete-student').off().click(function(e){
                    e.preventDefault();
                    $('#id-delete').val($(this).data('id'));
                    $('#delete-from-school').val($(this).data('schooldelete'));

                    $('#deleteStudentModal').modal('show');

                    $("form").attr("action","http://jpdesign.ba/sime_test/ucenici/details_skole.php?id=" + $('#delete-from-school').val());

                });

            }
        });
    });

    /* 11 - ucitavanja cetiri po cetiri skole na stranici statistika.php; prvo je definisana globalna varijabla value
    * cija vrijednost se povecava za cetiri sa svakim narednim klikom; skole se u formi panela dodaju na vec postojece,
    * ukoliko su sve skole ucitane sa servera je vracena poruka error nakon cega se prikazuje notifikacija da vise nama
    * skola za ucitavanje i disejbluje se dugme za ucitavanje; nakon svakog klika, tacnije uspjesnog AJAX poziva stranica
    * se skrola na dno*/
    var value = 4;
    $('#more-schools').off().click(function(e){
        e.preventDefault();

        $('#loading').css('display','block');

        $.ajax({
            url: "http://jpdesign.ba/sime_test/ucenici/components/loading_schools.php",
            type: "POST",
            data: {add: value},
            dataType  : "text",
            cache: false,
            success: function(response){
                console.log(response);
                $('#loading').css('display','none');

                if(response.trim() == "error"){
                    $('.alert').css('display','block');
                    $('#more-schools').prop('disabled',true);
                }
                else{
                    $('#added-schools').append(response);
                    value = value + 4;
                }

                $(document).scrollTop($(document).height());

            }
        });

    });

    /* 12 - validacija za JIB broj prilikom unosa nove skole, koriscenjem AJAX tehnologije; response je u JSON formatu,
    * kao niz koji sadrzi podatke validation_message, validation_state, glyphicon i save_button; odgovor sa servera se
    * kao argument prosljedjuje funkciji validate_input; ova funkcija prikazuje odgovarajucu poruku u skladu sa rezultatom
    * validacije, na osnovu validation_state i glyphicon clanova responsea, podesava se izgled polja za unos, odnosno prikaz
    * polja sa bojom i odgovarajucim glyphiconom; na osnovu clana responsea save_button se disejbluje/enejbluje dugme Save
    * changes (nije disejblovano samo ukoliko je uneseni JIB prosao validaciju)*/
    $('#jib').off().on("propertychange keyup input paste",function() {

        $.ajax({
            url: "http://jpdesign.ba/sime_test/ucenici/components/validate_input.php",
            type: "POST",
            data: {input_name: $(this).attr("name"), input_value: $(this).val()},
            dataType: "json",
            cache: false,
            success: function(response){
                console.log(response);
                validate_input('jib',response);
            }

        });

    });

    function validate_input(input_id, validation)
    {
        var input_label_id = '#' + input_id + '-label';
        var current_class = $('#'+input_id).parent('div').attr('class');
        if(validation.validation_message != "")
        {
            $(input_label_id).css('display','block');
            $(input_label_id).empty();
            $(input_label_id).html(validation.validation_message);

            $('#'+input_id).parent('div').removeClass(current_class);
            $('#'+input_id).parent('div').addClass('form-group ' + validation.validation_state);

            $('#add-class').removeClass().addClass('glyphicon '+ validation.glyphicon + ' form-control-feedback');

            $('.btn-submit').removeProp('disabled').prop(validation.save_button,true);

        }
    }

    /* 13 - sakrivanje polja za pretragu u fajlu statistika.php, jer se tu nikakva pretraga ne obavlja*/
    $('#hide-search-statistika').hide();

});
