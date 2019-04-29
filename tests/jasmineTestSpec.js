//used to test with Jasmine
//tutorial found at https://www.techiediaries.com/jasmine-testing-tutorial/

const js = require("../../public/assets/js/script.js");

describe(">Boolean Conversion", function() {
    //check if function is defined
    it("string to boolean should be defined",function() {
        expect(js.stringToBoolean).toBeDefined();  
      });
    //check expected results
    it("string to boolean return true",function() {
      expect(js.stringToBoolean("Yes")).toBeTruthy();  
    });
    it("string to boolean return false",function() {
        expect(js.stringToBoolean("No")).toBeFalsy();  
    });

    //check if function is defined
    it("string to boolean should be defined",function() {
        expect(js.booleanToString).toBeDefined();  
      });
    //check expected results
    it("string to boolean return true",function() {
      expect(js.booleanToString(1)).toEqual("Yes");  
    });
    it("string to boolean return false",function() {
        expect(js.booleanToString(0)).toEqual("No");  
    });
    
});