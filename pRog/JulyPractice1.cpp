#include<iostream>

using namespace std;

int A[101];
int B[101];
int main(void){
	int t,n,k,count;
	cin>>t;
	while(t--){
		count = 0;
		cin>>n>>k;
		
		for(int i=0;i<=100;i++){
			B[i] = 0;
		}
		for(int i=0;i<n;i++){
			cin>>A[i];
		}
		for(int i=0;i<n;i++){
			if(A[i] == i+1){
				B[A[i]] = -1;
			}else{
				if(B[A[i]] != -1){
					B[A[i]]+=1;
				}
			}
		}
		for(int i=1;i<=n;i++){
			if(B[i]>=k){
				count = count+1;
			}
		}
		cout<<count<<endl;
	}
	return 0;
}