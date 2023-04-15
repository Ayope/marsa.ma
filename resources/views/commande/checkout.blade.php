@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column w-100 justify-content-center my-3 containerOfAll">
        <form action="" method="POST">
            <div class="card mb-3">
                <div class="d-flex justify-content-between card-header bg-success text-white">
                    <h5 class="mb-0">Adresse</h5>
                    <a href="" class="d-flex align-items-center text-dark">
                        Modifier
                    </a>
                </div>
                <div class="card-body">
                    <p class="card-text">Ayoub El Ayouk<br>بلوك 14 رقم 147 الحي الصناعي الصويرة<br>Marrakech-Tensift-Al Haouz
                        - ESSAOUIRA<br>+212 614076644</p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Livraison</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Livraison à domicile<br>Livraison entre le <em>22 avril</em> et le <em>24
                            avril</em></p>
                    <div class="d-flex flex-wrap justify-content-center">
                        <div class="text-center mb-3">
                            <img class="img-fluid float-left mr-3"
                                src="https://ma.jumia.is/unsafe/fit-in/150x150/filters:fill(white)/product/42/355663/1.jpg?2291"
                                alt="product image">
                            <p class="card-text mb-0">أسرار عقل المليونير</p>
                            <p class="card-text text-muted small">QTT: 1</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-success py-2">
                    <div class="d-flex align-items-center">
                        <h5 class="ml-2 mb-0 text-uppercase text-white font-weight-bold">Mode de Paiement</h5>
                    </div>
                    <a href="" class="d-flex align-items-center text-dark">
                        Modifier
                    </a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center py-2">
                    <div class="d-flex align-items-center">
                        <div>
                            <span class="d-block font-weight-bold">Paiement cash à la livraison</span>
                            <span class="d-block text-muted">Payez en espèces dès que vous recevez votre commande.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-3 border border-dark p-3 w-25 rounded">
                <p>Total Products: <span></span> </p>
                <p>Livraison: <span></span> </p>
                <hr>
                <p><strong> Total:</strong> <span></span> </p>

                <button type="submit" class="btn btn-success">
                    Confirm commande
                </button>
            </div>
        </form>
    </div>



    <div>

        <form method="post" id="addressForm" class="row">
            <div class="col16 row -phs">
                <div class="col8 -df -prm">
                    <div class="fi-w">
                        <div class="fi _fks -ltr -tal">+212</div><label class="lbl">Préfixe</label>
                    </div><input name="phonePrefix" value="+212" id="fi-phonePrefix" type="hidden">
                    <div class="fi-w -mlm -fw"><input pattern="[0-9]*" placeholder="Entrez votre numéro de téléphone"
                            required="" class="fi" type="tel" value="" id="fi-phone"
                            name="phone"><label class="lbl" for="fi-phone">Téléphone mobile</label></div>
                </div>
                <div class="col8 -df -plm">
                    <div class="fi-w">
                        <div >+212</div><label class="lbl">Préfixe</label>
                    </div><input name="additionalPhonePrefix" value="+212" id="fi-additionalPhonePrefix" type="hidden">
                    <div class="fi-w -mlm -fw"><input pattern="[0-9]*"
                            placeholder="Ajouter un numéro de téléphone additionnel" class="fi" type="tel"
                            value="" id="fi-additionalPhone" name="additionalPhone"><label class="lbl"
                            for="fi-additionalPhone">Téléphone mobile supplémentaire</label></div>
                </div>
            </div>
            <div class="col16 -phm">
                <div class="fi-w"><input placeholder="Entrez votre adresse" required="" class="fi"
                        type="text" value="" id="fi-address1" name="address1"><label class="lbl"
                        for="fi-address1">Adresse</label></div>
                <div class="fi-w"><input placeholder="Saisir des informations supplémentaires" class="fi"
                        type="text" value="" id="fi-address2" name="address2"><label class="lbl"
                        for="fi-address2">Information supplémentaire</label></div>
            </div>
            <div class="col16 -df -phm">
                <div class="fi-w -fw -mrxl"><select required="" class="sel" id="fi-regionId" name="regionId">
                        <option value="" disabled="">Sélectionner</option>
                    </select><label class="lbl" for="fi-regionId">Région</label></div>
                <div class="fi-w -fw"><select required="" class="sel" id="fi-cityId" name="cityId">
                        <option value="" disabled="" selected="">Sélectionner</option>
                    </select><label class="lbl" for="fi-cityId">Ville</label></div>
            </div>
            <div class="col16 -phm">
                <div class="fi-w _cb"><input class="cb" type="checkbox" value="1" id="fi-setAsDefault"
                        name="setAsDefault"><label class="lbl" for="fi-setAsDefault">Définir par défaut</label></div>
            </div>
            <div class="col16 -phn">
                <div class="-df -j-end -i-ctr -pam -hr"><a class="btn _def -mrs -pas"
                        href="/checkout/addresses/">Annuler</a><button class="btn _prim">Enregistrer</button></div>
            </div><input name="csrfToken" value="613be9876719f4b62568fb55a6a960cf" type="hidden">
        </form>

    </div>


    <style>
        @media (min-width: 1000px) {
            .containerOfAll {
                max-width: 75%;
            }
        }
    </style>
@endsection
