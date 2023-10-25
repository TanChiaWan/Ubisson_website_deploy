const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"login":{"uri":"login","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"]},"password.email":{"uri":"password\/email","methods":["POST"]},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"]},"password.update":{"uri":"password\/reset","methods":["POST"]},"password.confirm":{"uri":"password\/confirm","methods":["GET","HEAD"]},"home":{"uri":"home","methods":["GET","HEAD"]},"all_organization":{"uri":"all-organization","methods":["GET","HEAD"]},"all_user":{"uri":"all_user","methods":["GET","HEAD"]},"all_role":{"uri":"all_role","methods":["GET","HEAD"]},"all_permission":{"uri":"all_permission","methods":["GET","HEAD"]},"all_patient":{"uri":"all_patient","methods":["GET","HEAD"]},"all_patient2":{"uri":"all_patient2","methods":["GET","HEAD"]},"create_org":{"uri":"create_org","methods":["GET","HEAD"]},"create_user":{"uri":"create_user","methods":["GET","HEAD"]},"organizations.show":{"uri":"organizations\/{organizationid_FK}","methods":["GET","HEAD"]},"insert.create":{"uri":"create","methods":["POST"]},"create_patient":{"uri":"create_patient","methods":["GET","HEAD"]},"insert2.create":{"uri":"create2","methods":["POST"]},"aboutpatient":{"uri":"aboutpatient\/{patientId}","methods":["GET","HEAD"]},"editpage":{"uri":"editpage","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };