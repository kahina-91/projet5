class TrouverNounou
{ 
	constructor()
	{
		this.macarte = document.getElementById('carte');
		this.mymap = L.map(this.macarte).setView([35.0000272, 2.9999826], 7);
        this.infos = document.getElementsByClassName('infos');
       
    }
  creatMap()
	{ 
	    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                 attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                 minZoom: 1,
                 maxZoom: 20
              }).addTo(this.mymap);
        
        //L.marker([36.7621090707009, 2.9587682489693545], {icon : myIcon}).addTo(this.mymap);
            let xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = () => {
                 
                if(xmlhttp.readyState == 4){
                    // Si la transaction est un succès
                    if(xmlhttp.status == 0 || xmlhttp.status == 200){
                        // On traite les données reçues
                        let donnees = JSON.parse(xmlhttp.responseText);
                        
                        Object.entries(donnees.agences).forEach(agence => {
                             let myIcon = L.icon({
                                iconUrl: "images/icon.png",
                                iconSize:     [60, 55],
                                shadowSize:   [50, 64],
                                iconAnchor:   [22, 94],
                                shadowAnchor: [4,  62],
                                popupAnchor:  [-3,-76]
                             });
                            document.getElementById("infos").textContent = agence;
                            let marker = L.marker(
                                 [agence[1].lat, 
                                 agence[1].lon]/*, 
                                 {icon : myIcon}*/
                            ).addTo(this.mymap)
                            marker.bindPopup(agence[1].ville).on('click', function(e)
                            {
                                document.getElementById("infos").textContent = agence[1].ville + agence[1].lat + agence[1].lon;
                            });
                        })
                        
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