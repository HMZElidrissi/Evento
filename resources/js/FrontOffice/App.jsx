import React from "react";
import ReactDOM from "react-dom";

function FrontOfficeApp() {
    return <div>Welcome to the Front Office</div>;
}

if (document.getElementById("front-office")) {
    ReactDOM.render(
        <FrontOfficeApp />,
        document.getElementById("front-office")
    );
}
