class InsertNounou
{ 
	constructor()
	{

        this.valid = document.getElementsByClassName("formValidNounou");
        this.chek = document.getElementsByClassName("button");
       
    }
    validat()
    {
        
        this.chek.style.display = 'none';

    }
}

const insert = new InsertNounou();
insert.validat();