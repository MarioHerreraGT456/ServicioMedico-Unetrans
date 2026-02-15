@extends('layouts.app')

@section('content')
<main class="home-main">
<section class="hero">
<div class="hero__container-text">
<p class="hero__title">Bienvenido al Servicio Médico de la UNETRANS</p>
<p class="hero__text">Servicio médico de la Universidad Nacional Experimental del Transporte, 
                    ubicada en el kilómetro 8 de la Carretera Panamericana, Edo. Miranda, Venezuela. Ofrecemos 
                    medicina general, psiquiatría y odontología</p>
</div>
<div class="hero__container-img">
<img alt="imagen médico" class="hero-img" onerror="this.style.display='none'" src="img/UNETRANS.jpg"/>
</div>
</section>
<section class="about">
<div class="about__container-text">
<p class="about__title">Sobre Nosotros</p>
<p class="about__text">La Universidad Nacional Experimental del Transporte (UNETRANS) ofrece un sistema de gestión integral para facilitar la operación del área de bienestar estudiantil y servicios médicos. Nuestro objetivo es garantizar atención de calidad en medicina general, psiquiatría y odontología, con un enfoque en el bienestar y el rendimiento académico y laboral de la comunidad.</p>
</div>
<div class="about__container-img">
<img alt="doctor" class="about-img" onerror="this.style.display='none'" src="img/doctor.jpg"/>
</div>
</section>
<section class="mission" id="mision">
<div class="mission__container-img">
<img alt="" class="mission-img" onerror="this.style.display='none'" src="img/mision.jpg"/>
</div>
<div class="mission__container-text">
<p class="mission__title">Misión</p>
<p class="mission__text">Brindar atención integral en salud a la comunidad universitaria a través de servicios de primeros auxilios, consultas de atención inmediata, jornadas de prevención y evaluaciones de salud. Nuestro objetivo es garantizar el bienestar físico y mental de nuestros estudiantes y personal, ofreciendo tratamientos programados y prescripciones adecuadas según los diagnósticos clínicos, promoviendo así una cultura de salud y prevención. </p>
</div>
</section>
<section class="vision">
<div class="vision__container-text">
<p class="vision__title">Visión </p>
<p class="vision__text">Ser un referente en la atención médica universitaria, reconocido por la calidad de nuestros servicios y el compromiso con la salud de nuestra comunidad. Aspiramos a fomentar un ambiente saludable que propicie el desarrollo académico y personal, implementando programas innovadores de prevención y promoción de la salud que respondan a las necesidades cambiantes de nuestros estudiantes y personal.</p>
</div>
<div class="vision-container-img">
<img alt="vision" class="vision-img" onerror="this.style.display='none'" src="img/vision.jpg"/>
</div>
</section>
<section class="container-values__name">
<p class="container-values__title">Valores</p>
</section>
<section class="values">
<div class="values-card__container">
<div class="values-card">
<div class="values-card__container-img">
<img alt="respeto" class="values-card__img" onerror="this.style.display='none'" src="img/respeto.jpg"/>
</div>
<p class="values-card__title">Respeto</p>
<p class="values-card__text">Valoramos la dignidad de cada individuo, promoviendo un ambiente inclusivo y empático en todas nuestras interacciones.</p>
</div>
</div>
<div class="values-card__container">
<div class="values-card">
<div class="values-card__container-img">
<img alt="" class="values-card__img" onerror="this.style.display='none'" src="img/excelencia.jpg"/>
</div>
<p class="values-card__title">Exelencia</p>
<p class="values-card__text">Buscamos la mejora continua en nuestros servicios, garantizando un alto estándar de atención y profesionalismo.</p>
</div>
</div>
<div class="values-card__container">
<div class="values-card">
<div class="values-card__container-img">
<img alt="" class="values-card__img" onerror="this.style.display='none'" src="img/prevencion.jpg"/>
</div>
<p class="values-card__title">Prevencion</p>
<p class="values-card__text">Fomentamos la salud y el bienestar a través de programas educativos y actividades que promuevan hábitos saludables.</p>
</div>
</div>
<div class="values-card__container">
<div class="values-card">
<div class="values-card__container-img">
<img alt="" class="values-card__img" onerror="this.style.display='none'" src="img/confidencialidad.jpg"/>
</div>
<p class="values-card__title">Confidencialidad</p>
<p class="values-card__text">Mantenemos la privacidad de los pacientes, asegurando que toda la información médica se maneje con discreción.</p>
</div>
</div>
<div class="values-card__container">
<div class="values-card">
<div class="values-card__container-img">
<img alt="" class="values-card__img" onerror="this.style.display='none'" src="img/colaboracion.jpg"/>
</div>
<p class="values-card__title">Colaboración</p>
<p class="values-card__text">Trabajamos en equipo con otros profesionales de la salud y la comunidad universitaria para brindar un servicio integral y efectivo.</p>
</div>
</div>
<div class="values-card__container">
<div class="values-card">
<div class="values-card__container-img">
<img alt="" class="values-card__img" onerror="this.style.display='none'" src="img/compromiso.jpg"/>
</div>
<p class="values-card__title">Compromiso</p>
<p class="values-card__text">Nos dedicamos a ofrecer atención médica de calidad, asegurando el bienestar y la salud de nuestra comunidad universitaria.</p>
</div>
</div>
</section>
<div id="authOverlayContainer"></div>
</main>
@endsection