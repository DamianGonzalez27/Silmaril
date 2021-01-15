import React from "react";

export default function Home()
{
    return(
        <div className="home">
            <div>
                <h1 className="titulo">Silmaril</h1>
            </div>
            <div>
                <ul className="listado">
                    <li>
                        <a href="http://damiandev.herokuapp.com/" target="_blank">DamianDev</a>
                    </li>
                    <li>
                        <a href="https://github.com/DamianGonzalez27/Silmaril" target="_blank">Repositorio</a>
                    </li>
                    <li>
                        <a href="mailto:ing.gonzaleza@outlook.com">Mandame un correo</a>
                    </li>
                </ul>
            </div>
        </div>
    )
}