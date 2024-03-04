import React from "react";
import ReactDOM from "react-dom";

function BackOfficeApp() {
    return <div>Welcome to the Back Office Dashboard</div>;
}

if (document.getElementById("back-office")) {
    ReactDOM.render(
        <BackOfficeApp />,
        document.getElementById("back-office")
    );
}
