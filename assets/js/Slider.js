class Slider
{
	constructor()
	{
        this.slideIndex = 0;
        this.myIndex = 0;
	  	this.slide = document.getElementsByClassName("slide");
        
    }
    
    carousel() 
    {
    	let i;
	  	for (i = 0; i < this.slide.length; i++) {
		    this.slide[i].style.display = "none";  
	  	}
	    this.myIndex++;
	  	if (this.myIndex > this.slide.length) {this.myIndex = 1}    
	  	this.slide[this.myIndex-1].style.display = "block"; 
	}
	run()
	{
		setInterval(this.carousel.bind(this), 3000);
	}
}

const slider = new Slider();
slider.run();
