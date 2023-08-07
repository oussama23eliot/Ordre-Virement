<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{$title}}</title>
</head>

<body style="width:100%">
    <div class="main" style=" display: flex;flex-direction: column;width: 80%;margin: auto;height: 95%; align-items: center;margin-top:40px">
        <div style="display:grid;grid-template-columns:1fr;justify-items: center
;width:100%;align-items: center;border:2px solid black;margin-bottom:20px">
            <h2 style="justify-items: center
;width:100%;align-items: center;text-align:center">ORDRE DE VIREMENT</h2>
        </div>
        <div style="display:grid;grid-template-columns:1fr;justify-items: center
;width:100%;align-items: center;margin-top:20px">
            <p style="justify-items: center
;width:100%;align-items: center;text-align:right;text-decoration:underline">Rabat le : {{date('d/m/Y', strtotime($virement["date"]))}}</p>
        </div>
        <div style="display:table;justify-items: center
;width:100%;align-items: center;margin-top:30px;border:2px solid black;text-align:center">
            <div style="display:table-row; width: 100%;border-bottom: 1px solid black;padding:6px 0px">
                <p style="display: table-cell; border-bottom: 1px solid black;padding:6px 0px">Objet : Ordre de Virement</p>
            </div>
            <div style="display:table-row;  width: 100%;padding:6px 0px">
                <p style="display: table-cell;padding:6px 0px">Bénéficiaire : {{$virement["nom_beneficiaire"] }}</p>
            </div>
        </div>

        <div style="display:table;justify-items: center
;width:100%;align-items: center;margin-top:30px;border:2px solid black;text-align:center">
            <div style="display: table-row;">
                <div style="display:table-cell ;width: 25%;padding:6px 0px;text-align: left;border-bottom: 1px solid black;border-right:2px solid black;">
                    <p style="margin: 0; padding-left: 3px;">Banque :</p>
                </div>
                <div style="display:table-cell; width: 75%;padding:6px 0px;border-bottom: 1px solid black;">{{$contact[4]["value"]}}</div>
            </div>
            <div style="display: table-row;">
                <div style="display:table-cell ;width: 25%;padding:6px 0px;text-align: left;border-bottom: 1px solid black;border-right:2px solid black;">
                    <p style="margin: 0; padding-left: 3px;">Compte :</p>
                </div>
                <div style="display:table-cell; width: 75%;padding:6px 0px;border-bottom: 1px solid black;">{{$contact[6]["value"]}}</div>
            </div>
            <div style="display: table-row;">
                <div style="display:table-cell ;width: 25%;padding:6px 0px;text-align: left;border-bottom: 1px solid black;border-right:2px solid black;">
                    <p style="margin: 0; padding-left: 3px;">Agence :</p>
                </div>
                <div style="display:table-cell; width: 75%;padding:6px 0px;border-bottom: 1px solid black;">{{$contact[5]["value"]}} </div>
            </div>
            <div style="display: table-row;">
                <div style="display:table-cell ;width: 25%;padding:6px 0px;text-align: left;border-bottom: 1px solid black;border-right:2px solid black;">
                    <p style="margin: 0; padding-left: 3px;">Adresse :</p>
                </div>
                <div style="display:table-cell; width: 75%;padding:6px 0px;border-bottom: 1px solid black;">{{$contact[7]["value"]}}</div>
            </div>
        </div>

        <div style="display:table; margin-top:30px;border: 2px solid black;border-bottom:0;width: 100%;padding:10px 0px;text-align:center;">Référence Bancaire du bénéficiaire : </div>
        <div style="display:table;justify-items: center
;width:100%;align-items: center;border:2px solid black;">
            <div style="display: table-row;width:100%">
                <div style="display:table-cell ;width: 25%;padding:6px 0px;text-align: left;border-bottom: 1px solid black;border-right:2px solid black;">
                    <p style="margin: 0; padding-left: 3px;">Banque :</p>
                </div>
                <div style="display:table-cell; width: 75%;padding:6px 0px;border-bottom: 1px solid black;text-align:center"> {{$virement["nom_banque"] }} </div>
            </div>
            <div style="display: table-row;width:100%">
                <div style="display:table-cell ;width: 25%;padding:6px 0px;text-align: left;border-bottom: 1px solid black;border-right:2px solid black;">
                    <p style="margin: 0; padding-left: 3px;">Compte :</p>
                </div>
                <div style="display:table-cell; width: 75%;padding:6px 0px;border-bottom: 1px solid black;text-align:center">{{$virement["rib"] }}</div>
            </div>
            <div style="display: table-row;width:100%">
                <div style="display:table-cell ;width: 25%;padding:6px 0px;text-align: left;border-bottom: 1px solid black;border-right:2px solid black;">
                    <p style="margin: 0; padding-left: 3px;">Code swift :</p>
                </div>
                <div style="display:table-cell; width: 75%;padding:6px 0px;border-bottom: 1px solid black;text-align:center">{{$virement["code_swift"] }} </div>
            </div>
            <div style="display: table-row;width:100%">
                <div style="display:table-cell ;width: 25%;padding:6px 0px;text-align: left;border-bottom: 1px solid black;border-right:2px solid black;">
                    <p style="margin: 0; padding-left: 3px;">Adresse :</p>
                </div>
                <div style="display:table-cell; width: 75%;padding:6px 0px;border-bottom: 1px solid black;text-align:center">{{$virement["adresse_agence"] }} </div>
            </div>
        </div>
        <div style="display:table;justify-items: center
;width:100%;align-items: center;margin-top:30px;border:2px solid black;text-align:center">
            <div style="display:table-cell ;width: 25%;padding:10px 0px;text-align: left;border-bottom: 1px solid black;border-right:2px solid black;">
                <p style="margin: 0; padding-left: 3px;font-weight:600">Montant</p>
            </div>
            <div style="display:table-cell; width: 75%;padding:10px 0px;border-bottom: 1px solid black;text-align:center;font-weight:600">MAD {{number_format($virement["montant"],2)}}</div>
        </div>
        <div style="display:grid;grid-template-columns:1fr;justify-items: center
;width:100%;align-items: center;margin-top:20px">
            <p style="justify-items: center
;width:100%;align-items: center;text-align:right;margin-right:60px;text-decoration:underline">Signature Autorisée : </p>
        </div>
    </div>
</body>

</html>