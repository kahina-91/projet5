class InsertNounou
{ 
	constructor()
	{
        
        this.button = document.getElementsByClassName("ajouter");
        this.confirmer = document.getElementById("confirmer");
        this.form = document.getElementsByClassName('formValidNounou');
        
    }
    validat()
    {
        this.confirmer.style.display = 'none'; 
        this.button.addEventListener('click', (event) => 
        {
            
            this.form.style.display = 'none'; 
            this.confirmer.style.display = 'block';
        }); 

    }
}

const insert = new InsertNounou();
insert.validat();
