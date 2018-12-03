<?php 

package LCUtils
{
	import flash.display.Shape;
 
	import mx.containers.Canvas;
	import mx.core.UIComponent;
 
	/**
	 * Cette classe gère la grille magnétique de l'application.
	 * Cela comprend la création de l'objet graphique et 
	 * le calcul de la "ligne magnétique" la plus proche d'une position donnée.
	 */ 
	public class LCMagneticGrid
	{
		// élément graphique de la grille magnétique
		private var gridShape : Shape ;
 
		//coordonnées des lignes magnétiques 
		private var horizontalSnappers : Array ;
		private var verticalSnappers : Array ;
 
		//position de l'élément à tester.
		private var testElementXPosition : Number ;
		private var testElementYPosition : Number ;
 
		// intervale entre les lignes.
		private var step : int ;
 
		/*
			initialisation de la grille en fonction des valeurs passées en paramètre.
		*/
		public function LCMagneticGrid(aWidth : int ,
							aHeight : int ,
							aStep : int = 10 ,
							aLineThickness : int = 1 ,
							aLineColor : uint = 0 ,
							aLineAlpha :  Number = 0.5 )
		{
			this.gridShape = new Shape() ;
			this.horizontalSnappers = new  Array() ;
			this.verticalSnappers =  new Array () ; 
			this.step = aStep * LCConstants.MILLIMETER_TO_PIXEL_RATIO ;
			this.createMagneticGrid(aWidth , aHeight , aLineThickness , aLineColor  , aLineAlpha ) ; 
		}
 
 
		/*
			création de l'objet graphique de la grille magnétique.
			initialisation des tableaux stockant les coordonnées horizontales & verticales
			des lignes magnétiques.
		*/
		private function createMagneticGrid ( aWidth : int ,aHeight : int ,	aLineThickness : int ,aLineColor : uint  ,aLineAlpha :  Number ) : void	{
			
			this.gridShape = new Shape () ;
			this.gridShape.graphics.lineStyle(aLineThickness, aLineColor,aLineAlpha);
 
			var currentPosition : int = 0 ;
 
			this.gridShape.graphics.moveTo(0,0);
			while (	currentPosition <= aHeight ) 
			{
				this.gridShape.graphics.lineTo(aWidth ,currentPosition) ;
				this.verticalSnappers.push (currentPosition) ;
 
				currentPosition += this.step ;
				this.gridShape.graphics.moveTo(0 , currentPosition) ;	
			}
 
			currentPosition = 0 ;
			this.gridShape.graphics.moveTo(0,0);
 
			while (currentPosition <= aWidth)
			{
				this.gridShape.graphics.lineTo(currentPosition , aHeight) ;
				this.horizontalSnappers.push (currentPosition);
 
				currentPosition += this.step ;
				this.gridShape.graphics.moveTo(currentPosition , 0);	
			} 
		}
 
		/*
			Ajoute dans un conteneur la grille magnétique crée précédemment.
		*/
		public function getMagneticGrid (aContainer : Canvas) : void
		{
			var conteneur : UIComponent = new UIComponent();
			conteneur.addChild(this.gridShape) ;
			conteneur.includeInLayout = false ;
 
			aContainer.addChild(conteneur) ;
		}
 
		/*
			Si l'element est proche d'une ligne horizontale, 
			les coordonnées de cette dernière sont retournées.
		*/
		public function isElementSnappingToX (anElementXPosition : Number) : Number
		{
			this.testElementXPosition = anElementXPosition ;
 
			// on récupère l'ensemble des lignes proches de la position de l'élément.
			var result : Array = this.horizontalSnappers.filter(snapsToX) ;
 
			if (result.length > 0)
			{ return result.pop(); }
			else
			{ return LCConstants.NO_INT_VALUE ; }
 
		}
 
		/*
			Si l'element est proche d'une ligne verticale, 
			les coordonnées de cette dernière sont retournées.
		*/
		public function isElementSnappingToY (anElementYPosition : Number) : Number
		{
			this.testElementYPosition = anElementYPosition ;
 
			// on récupère l'ensemble des lignes proches de la position de l'élément.
			var result : Array = this.verticalSnappers.filter(snapsToY) ;
 
			if (result.length > 0)
			{ return result.pop(); }
			else
			{ return LCConstants.NO_INT_VALUE ; }
		}
 
		/*
			retourne vrai si l'element est à proximité de la grille.
		*/
		private function snapsToX (element : Number , index : int , arr :Array) : Boolean
		{ 
			var minMagnet : Number = element - this.step/3  ;
			var maxMagnet : Number = element + this.step/3 ;
			return ((testElementXPosition > minMagnet) && (testElementXPosition < maxMagnet)) ; 
		}
 
		/*
			retourne vrai si l'element est à proximité de la grille.
		*/
		private function snapsToY (element : Number , index : int , arr : Array) : Boolean
		{
			var minMagnet : Number = element - this.step/3  ;
			var maxMagnet : Number = element + this.step/3 ;
			return ((testElementYPosition > minMagnet) && (testElementYPosition < maxMagnet)) ; 
		}
	}
}

?>