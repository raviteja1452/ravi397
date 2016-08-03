#include<iostream>
using namespace std;
int main(void){
	int t,n,l,r;
	cin>>t;
	while(t--){
		cin>>n;
		cin>>l>>r;
		while(l>=0 && r>=0 && n>0){
			if(l>r){
				l = l-r;
			}else{
				r = r-l;
			}
			n--;
		}
		if(n==0 && l*r > 0){
			cout<<"Yes"<<" "<<l*r<<endl;
		}else{
			cout<<"No"<<endl;
		}
	}
	return 0;

}