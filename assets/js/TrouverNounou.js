class TrouverNounou
{ 
	constructor()
	{
		this.macarte = document.getElementById('carte');
		this.mymap = L.map(this.macarte).setView([35.0000272, 2.9999826], 7);
       
    }
  creatMap()
	{ 
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
         }).addTo(this.mymap);
   

       let xmlhttp = new XMLHttpRequest();

       xmlhttp.onreadystatechange = () => {
            
           if(xmlhttp.readyState == 4)
           {
               if(xmlhttp.status == 0 || xmlhttp.status == 200)
               {
                   let donnees = JSON.parse(xmlhttp.responseText);
                   
                   Object.entries(donnees.nounousValids).forEach(nounou => {
                        let myIcon = L.icon({
                           iconUrl: "images/icon.png",
                           iconSize:     [60, 55],
                           shadowSize:   [50, 64],
                           iconAnchor:   [22, 94],
                           shadowAnchor: [4,  62],
                           popupAnchor:  [-3,-76]
                        });
                      
                       let marker = L.marker(
                            [nounou[1].lat, 
                            nounou[1].lon]
                       ).bindPopup("").addTo(this.mymap);
                       let mapopup = marker.getPopup();
                       mapopup.setContent('Nom et prenom: '+nounou[1].nom+' '+nounou[1].prenom+'<br/>'+
                       'Adress: '+nounou[1].adress+'<br/>');
                       
                   });
                   
               }else{
                   console.log(xmlhttp.statusText);
               }
           }
       }

       xmlhttp.open("GET", "http://localhost/projet5/showMarkers");

       xmlhttp.send(null);
   
    }
}

 let trouver = new TrouverNounou();
 trouver.creatMap();



 