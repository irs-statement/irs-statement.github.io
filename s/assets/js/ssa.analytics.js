if (typeof SSA == "undefined" || !SSA) { var SSA = {}; }

(function() {
  SSA.Analytics = {
    thisFileName: "ssa.analytics.js",
    analyticsFileName: "analytics.js",
    trackerName: "ssa",
    init: function() {
	// Get path of locally hosted analytics.js
        var filePath = SSA.Analytics.getJavaScriptFilePath();
        if(filePath) {
          filePath += SSA.Analytics.analyticsFileName;
        }

	/// Create command queue and load locally hosted analytcs.js file.
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script',filePath,'ga');

	// Get GA Property ID and cookie domain.
	var gaID = document.documentElement.getAttribute("data-analytics-trackingid");
	var hostname = document.location.hostname;
	hostname = hostname.toLowerCase();
	if(!gaID) { gaID = 'UA-25977386-2' }

	// Create tracker.
      	ga('create',gaID, {'cookieDomain': hostname, 'allowLinker': true, 'anonymizeIp': true,'name':SSA.Analytics.trackerName,'forceSSL':true});
	ga(SSA.Analytics.trackerName+'.require','displayfeatures');
	ga(SSA.Analytics.trackerName+'.require','linkid');

	// Determine page URL and send to GA.
	var pageID = document.documentElement.getAttribute("id");
	var applicationID, pageDescription;
	var metaTags = document.getElementsByTagName("meta");

	for(var i = 0; i < metaTags.length; i++) {
		if(!applicationID && metaTags[i].name == "application-name") {
			applicationID = metaTags[i].content;
		} else if(!pageDescription && metaTags[i].name == "description") {
			pageDescription = metaTags[i].content;
		}
	}
	if(applicationID && pageDescription) {
		ga(SSA.Analytics.trackerName+'.send','pageview', applicationID + "/" + pageDescription);
	} else if(pageID) {
		ga(SSA.Analytics.trackerName+'.send','pageview', pageID);
	} else {
		ga(SSA.Analytics.trackerName+'.send','pageview');
	}

    },

    getJavaScriptFilePath: function() {
      var scriptFiles = document.getElementsByTagName("script");
      var filePath = "";
      var found = false;
      for(var i = 0; !found && i < scriptFiles.length; i++) {
        var fileNameIndex = scriptFiles[i].src.indexOf(SSA.Analytics.thisFileName);
        if(fileNameIndex != -1) {
          filePath = scriptFiles[i].src.substring(0, fileNameIndex);
          found = true;
        }
      }

      return filePath;
    }
  };
})();

if(typeof YAHOO != "undefined" && YAHOO) {
  YAHOO.util.Event.addListener(window,'load',SSA.Analytics.init);
} else {
  if(typeof $ != "undefined" && $) {
    $(document).ready(SSA.Analytics.init);
  }
}
