App = {
	
	web3Provider: null,
	contracts: {},

	init: async function() {

		return await App.initWeb3();
	},

	initWeb3: async function() {

		if(window.web3) {
			App.web3Provider = window.web3.currentProvider;
		}
		else {
			App.web3Provider = new Web3.providers.HttpProvider('http://localhost:7545');
		}

		web3 = new Web3(App.web3Provider);
		return App.initContract();
	},

	initContract: function() {

		$.getJSON('vote.json',function(data){

			var voteArtifact = data;
			App.contracts.vote = TruffleContract(voteArtifact);
			App.contracts.vote.setProvider(App.web3Provider);
		  return App.displayVotes();
		});
		
	},

	displayVotes: function() {

		var voteInstance;

		App.contracts.vote.deployed().then(function(instance){

			voteInstance=instance;
			return voteInstance.viewVote.call();

		}).then(function(votes){
			console.log(votes);
			document.getElementById('v1').innerHTML = votes[0]['c'][0];
			document.getElementById('v2').innerHTML = votes[1]['c'][0];
			document.getElementById('v3').innerHTML = votes[2]['c'][0];
			document.getElementById('voters').innerHTML= votes[0]['c'][0] + votes[1]['c'][0] + votes[2]['c'][0] ;

		}).catch(function(err){
			console.log(err.message);
		});
	}
};

$(function() {
  $(window).load(function() {
    App.init();
  });
});