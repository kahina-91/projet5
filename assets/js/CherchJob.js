class CherchJob
{
	constructor()
	{

        this.cherche = document.getElementsByClassName('chercheForm');
        console.log(this.cherche);

    }

    cacheForm()
    {

        this.cherche.style.display = "none";

    }
}

const chercheJob = new CherchJob();
chercheJob.cacheForm();