#include<iostream>
using namespace std;

int sumOfDigits(int x)
{	
	int sum = 0;
	while(x>0){
		sum = sum + x%10;
		x = x/10;
	}
	return sum;
}

int main(void){
	int n;
	cin>>n;
	int k = n-97;
	if(k<=0)
	{
		k = 1;
	}
	int count = 0;
	for(int i = k;i<=n;i++){
		int s = sumOfDigits(i);
	 	int ss = sumOfDigits(s);
		if(i+s+ss == n){
			count += 1;
		}
	}
	cout<<count;
	return 0;
}
