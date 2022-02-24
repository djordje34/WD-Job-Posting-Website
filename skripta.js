
function prikaziVise(nesto){                        //dodaje tamnu pozadinu i aktivira meni za prikaz vise info o oglasu
    var id=nesto
    console.log(id)

    var shad=document.getElementById('shadowed')
    shad.style.display='inline-block'

    var neki=document.getElementById(nesto).childNodes[1].textContent;          //glavni elementi za odredjeni oglas
    var opis=document.getElementById(nesto).childNodes[2].textContent;
    var izdavac=document.getElementById(nesto).childNodes[3].textContent;       //kod ispod predstavlja resenje problema pakovanja informacija u iznad navedenom meniju
    neki=neki.split('  ')
    var fin=new Array();
    var ctr=0;
    for(var i=0;i<neki.length;i++){
        fin[ctr++]=neki[i].split(':');
    }
    var reci=new Array("Ime kompanije: ","Lokacija kompanije: ","Nivo obrazovanja: ","Tip inženjeringa: ","Prijava traje do: ","Kontakt telefon: ","Opis posla: ");
    var ids=new Array("im","lok","nivo","inz","prij","kont")
    //var url = "index.php?" + nesto + "=";
    var nekidiv=document.getElementById("vise");
    nekidiv.style.display="inline-block";
    var kontent=document.getElementById("contents");
    kontent.innerHTML="";                                                                                                                                                                         //prijava.php?id="+id+"&ime="+ime+"&lokacija="+l+"&nivo="+n+"&inz="+inz+"&prijava="+p+"&kont="+k                                                                                                         
    kontent.innerHTML=kontent.innerHTML+"<p style='margin:0;padding:20px;color:black;opacity:1;border-bottom:3px solid #FFC312;border-radius:20px;'>"+"Ime kompanije: "+"<a id='imeime' style='text-decoration: none;color:red;' href='kompanija.php?ime="+fin[0][1]+"&lokacija="+fin[1][1]+"&inz="+fin[3][1]+"&kont="+String(fin[5][1])+"'>"+fin[0][1]+"</a></p>";
    for(var i=1;i<fin.length;i++){
        kontent.innerHTML=kontent.innerHTML+"<p style='margin:0;padding:20px;color:black;opacity:1;border-bottom:3px solid #FFC312;border-radius:20px;' id='"+ids[i]+"'>"+reci[i]+fin[i][1]+"</p>";
    }
    kontent.innerHTML+="<p style='margin:0;padding:15px;color:black;opacity:1;'id='op'>"+"Opis posla: "+opis+"</p>";
    //popravi ovo
    kontent.innerHTML+="<p id='helper'style='display:none;'>"+nesto+"</p>";
   return false;
}
function prikaziVisenp(nesto){                                              
    var id=nesto
    console.log(id)
    var neki=document.getElementById(nesto).childNodes[1].textContent;
    var opis=document.getElementById(nesto).childNodes[2].textContent;
    var izdavac=document.getElementById(nesto).childNodes[3].textContent;
    neki=neki.split('  ')
    var fin=new Array();
    var ctr=0;
    for(var i=0;i<neki.length;i++){
        fin[ctr++]=neki[i].split(':');
    }
    //fin[0][1]=fin[0][1].replace("'","`");  
    for(var i=0;i<fin.length;i++){
        console.log("OVO JE "+i+"-TI ELEMENT:"+fin[i][1]+"\n");
    }
    var reci=new Array("Ime kompanije: ","Lokacija kompanije: ","Nivo obrazovanja: ","Tip inženjeringa: ","Prijava traje do: ","Kontakt telefon: ","Opis posla: ");
    var ids=new Array("im","lok","nivo","inz","prij","kont")
    //var url = "index.php?" + nesto + "=";
    var nekidiv=document.getElementById("vise");
    nekidiv.style.display="inline-block";
    var kontent=document.getElementById("contents");
    kontent.innerHTML="";              
                                                                                                                                                              //prijava.php?id="+id+"&ime="+ime+"&lokacija="+l+"&nivo="+n+"&inz="+inz+"&prijava="+p+"&kont="+k                                                                                                         
    kontent.innerHTML=kontent.innerHTML+"<p style='margin:0;padding:20px;color:black;opacity:1;border-bottom:3px solid #FFC312;border-radius:20px;'>"+"Ime kompanije: "+"<a id='imeime' style='text-decoration: none;color:red;' href='kompanijanp.php?ime="+fin[0][1].replace("'","`")+"&lokacija="+fin[1][1]+"&inz="+fin[3][1]+"&kont="+String(fin[5][1])+"'>"+fin[0][1]+"</a></p>";
    for(var i=1;i<fin.length;i++){
        kontent.innerHTML=kontent.innerHTML+"<p style='margin:0;padding:20px;color:black;opacity:1;border-bottom:3px solid #FFC312;border-radius:20px;' id='"+ids[i]+"'>"+reci[i]+fin[i][1]+"</p>";
    }
    kontent.innerHTML+="<p style='margin:0;padding:15px;color:black;opacity:1;'id='op'>"+"Opis posla: "+opis+"</p>";    //izbrisan </div>
    kontent.innerHTML+="<p id='helper'style='display:none;'>"+nesto+"</p>";
   return false;
}
function ugasi(){

    var nekidiv=document.getElementById("vise");
    nekidiv.style.display="none";
    var shad=document.getElementById('shadowed')
    shad.style.display='none'
    return false;
}
function izmeniOglas(nesto){                                //funkcija napisana samo kako bi se naslo odgovarajuce resenje, nije koriscena
    var neki=nesto;
    console.log(nesto)
    window.location.href="promenioglas.php?id="+neki;
}
function prijaviMe(){                                           //redirekcija na oglas na koji korisnik czeli da se prijavi
    var id=document.getElementById('helper').textContent
    var ime=document.getElementById("imeime").textContent

    var arr=new Array()
    var ids=new Array("lok","nivo","inz","prij","kont")         //Gid-jevi

    for(var i=0;i<ids.length;i++){
        arr[i]=document.getElementById(ids[i]).textContent       //id-jevi i njihov content             
            console.log(arr[i].textContent)
    }                                                                       


    for(var j=0;j<arr.length;j++){
        arr[j]=arr[j].split(": ")                               //arr sadrzi kompletan list stringova, sto znaci ovo, npr. Ime:Pera Peric, nama samo treba deo nakon 'Ime:'
    }
 
    els=new Array()
    els=['lokacija','nivo','inz','prijava','kont']              //informacije koje stoje uz GET elemente  
    finale='prijava.php?id='+id+'&ime='+ime;                    //polje ime je odvojeno u odnosu na ostale parametre, razlog je jer IME radi kao referenca na stranicu kompanija

    for(var k=0;k<els.length;k++){                              //pravi odgovarajuci https na koji se redirektuje, sadrzi sve potrebne GET elemente
        finale+='&'+els[k]+'='+arr[k][1];
    }
    window.location=finale
    //window.location="prijava.php?id="+id+"&ime="+ime+"&lokacija="+l+"&nivo="+n+"&inz="+inz+"&prijava="+p+"&kont="+k+"";
    return false
}

function getOcena(){                                                            //ova funkcija se ne koristi, pisana ovde radi provere algoritma
    var ocena=document.getElementById('ocenaFirme').textContent                
    var gde=document.getElementById('prosecnaOcena')    
    Math.round(ocena * 100) / 100
    gde.textContent+="<b>"+ocena+"</b>"
    prosecna=document.getElementById('prosek')
    prosecna.textContent+=ocena
}

function showStars(nesto){          //provera funkcije koja je kasnije odradjena
    var id=nesto

    var ocena=document.getElementById('ocenaKorisnika').textContent
    var zvezde=document.getElementById('zvezde'+nesto).childNodes

    for(var i=1; i<zvezde.length;i+=2){
        if(ocena>=zvezde[i].getAttribute("name"))
        zvezde[i].style='color:green'
    }

}
function showBolje(){
var elementi=document.getElementsByClassName("star-icon")               //funkcija za prikazivanje zvezda
for (var i=0;i<elementi.length-1;i++){                              
    ids=elementi[i].getAttribute('id')
    var nums=ids.match(/\d+/g);                                         //vraca samo id korisnika, ime id-ja je zvezdeX gde je X id
    num=nums[0]
    ocena=document.getElementById('ocenaKorisnika'+num).textContent     //uzimamo ocenu tog korisnika
    
    //var id='zvezde'+i
    //var ocena=document.getElementById('ocenaKorisnika').textContent
    //var zvezde=document.getElementById(id).childNodes

    var zvezde=elementi[i].childNodes                                   //uzimamo sve zvezde
    for(var j=0;j<zvezde.length;j++){
        if(zvezde[j].nodeName!='#text'){                                //zvezde list sadrze element #text, koji nam ne treba
        var neki=zvezde[j].getAttribute('name')                         //neki vraca poziciju zvezde, pozicija 3->tezina zvezde 3
        if(neki<=ocena){                                                //ako je tezina zvezde <= oceni, oboji
            zvezde[j].style='color:#ffc312'
        }
    }
    }
    }
}
function konacnaOcena(){                                                //ova funkcija racuna konacnu ocenu, tako sto nakon sto pomocu celog dela ukupne ocene oboji zvezde
    var ocena=document.getElementById('prosek').textContent             //uzima ostatak i u odnosu na to koliki je, dodaje transparency na ceil(ocena) zvezdu
    var gde=document.getElementsByClassName('zvezde')                   //manji ostatak, ceil(ocena) zvezda transparency ce biti manji, tj. zvezda ce biti vise providna
    var ovde=gde[0].childNodes
    var ost=ocena%1
    ocena=ocena-ost
    for(var i=0;i<ovde.length;i++){
        if(ovde[i].nodeName!='#text'){
            var neki=ovde[i].getAttribute('name')
            if(neki<=ocena){
                ovde[i].style='color:#ffc312'
                console.log(ocena)
            }
            if(ost>=0.25)
            if(neki-ocena==1){
                ovde[i].style='color:rgba(255, 195, 18,'+ost+");"
            }
        }
    }
}

function redirektuj(neki){                                          //ovo se moglo odraditi u jednu funkciju
    id=document.getElementById('redirekcija').textContent
    window.location.href="indexr.php?"+neki+"="+id;
    return false
}
function redirektujnp(neki){
    id=document.getElementById('redirekcija').textContent
    window.location.href="index.php?"+neki+"="+id;
    return false
}
function redirektujCV(neki){
    window.location.href="download.php?cvid="+neki;
    return false
}
function kaPrijavama(ajdi){
    id=ajdi
    window.location.href="prikaziprijave.php?id="+id;
    return false
}


function dodajSliku(){
    var neki=document.getElementById('dodajsliku')
    neki.innerHTML+="<p> DODATA SLIKA</p>";
    return false;
}